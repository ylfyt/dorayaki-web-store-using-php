<?php 

class Dorayaki extends Controller {

    public function index($id = null)
    {
        if (is_null($id)) {
            header('Location: ' . BASEURL);
            exit;
        }
        
        $data = [
            'title' => 'Detail',
            'is-admin' => $_SESSION['is-admin'],
            'username' => $_SESSION['username']
        ];

        $dora = $this->model('Dorayaki_model')->getDorayakiByID($id);
        $sold = $this->model('Dorayaki_model')->getSoldDorayaki($id);

        if(!$dora){
            header('Location: ' . BASEURL);
            exit;
        }

        if (!$sold){
            $dora['sold'] = 0;
        }
        else{
            $dora['sold'] = $sold['total'];
        }

        $data['dorayaki'] = $dora;

        
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('dorayaki/index', $data);
        $this->view('templates/footer', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Dorayaki',
            'username' => $_SESSION['username'],
            'is-admin' => $_SESSION['is-admin']
        ];


        if (isset($_POST['add'])){
            $url = $this->uploadphoto($_FILES['gambar']);
            if (!is_int($url)){
                $nama = htmlspecialchars($_POST['nama']);
                $deskripsi = htmlspecialchars($_POST['deskripsi']);
                $harga = htmlspecialchars($_POST['harga']);
                $stok = htmlspecialchars($_POST['stok']);

                $dora = [
                    'nama' => $nama,
                    'harga' => $harga,
                    'deskripsi' => $deskripsi,
                    'stok' => $stok,
                    'url' => $url
                ];

                $result = $this->model('Dorayaki_model')->insert($dora);
                if ($result == 0){
                    Flasher::setFlash(false, 'Dorayaki gagal ditambahkan!!');
                } 
                else{
                    Flasher::setFlash(true, 'Dorayaki berhasil ditambahkan');
                }
            }
            else{
                Flasher::setFlash(false, 'Gambar Error!!');
            }
        }



        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('dorayaki/add', $data);
        $this->view('templates/footer', $data);
    }

    public function uploadphoto($data)
    {
        $fileName = $data['name'];
        $fileSize = $data['size'];
        $error = $data['error'];
        $tempName = $data['tmp_name'];

        if ($error === 4){
            return -1;
        }

        $validExt = ['jpg', 'jpeg', 'png'];
        $names = explode('.', $fileName);
        $extension = end($names);
        $extension = strtolower($extension);
        
        if (!in_array($extension, $validExt)){
            return -2;
        }

        if ($fileSize > 1000000){
            return -3;
        }

        $newFileName = uniqid();
        $newFileName .= '.' . $extension;

        move_uploaded_file($tempName, '../public/img/'.$newFileName);
        
        $url = BASEURL . '/public/img/' . $newFileName;
        
        return $url;
    }

    public function buy($id = null)
    {

        if (!isset($_SESSION['username'])){
            header('Location: ' . BASEURL);
        }

        if (is_null($id)){
            header('Location: ' . BASEURL);
            exit;
        }

        if (isset($_POST['edit']) || isset($_POST['buy'])){
            $id = $_POST['iddora'];
            $jml = $_POST['jmlstok'];
            $jml = (int)$jml;

            if (isset($_POST['edit'])){
                $result = $this->model('Dorayaki_model')->changeStokDorayaki($id, $jml);
                if ($result == 1){
                    Flasher::setFlash(true, 'Stok Dorayaki berhasil diubah');
                }
                else{
                    Flasher::setFlash(false, 'Stok Dorayaki gagal diubah');
                }
            }
            else if (isset($_POST['buy'])){
                $result = $this->model('Dorayaki_model')->decreaseDorayaki($id, $jml);
                if ($result == 1){
                    $userId = $_SESSION['user-id'];
                    $result = $this->model('Pembelian_model')->insert($id, $userId, $jml);
                    if ($result == 1){
                        Flasher::setFlash(true, 'Pembelian dorayaki berhasil');
                    }
                    else {
                        Flasher::setFlash(false, 'Pembelian dorayaki gagal');
                    }
                }
                else{
                    Flasher::setFlash(false, 'Pembelian dorayaki gagal');
                }
            }
            
        }

        $data = [
            'title' => 'Pembelian',
            'is-admin' => $_SESSION['is-admin'],
            'username' => $_SESSION['username']
        ];

        $dora = $this->model('Dorayaki_model')->getDorayakiByID($id);
        $sold = $this->model('Dorayaki_model')->getSoldDorayaki($id);

        if(!$dora){
            header('Location: ' . BASEURL);
            exit;
        }

        if (!$sold){
            $dora['sold'] = 0;
        }
        else{
            $dora['sold'] = $sold['total'];
        }

        $data['dorayaki'] = $dora;

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('dorayaki/pembelian', $data);
        $this->view('templates/footer', $data);
    }

    public function buyfromajax()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data['error'] = true;
            $data['error-msg'] = 'request-method error';
            echo json_encode($data);
        }
        else
        {
            if (isset($_POST['action']))
            {
                if (!isset($_POST['iddora']) && !isset($_POST['jmlstok']) && !isset($_POST['userid'])){
                    $data['error'] = true;
                    $data['error-msg'] = 'params error';
                    echo json_encode($data);
                }
                else{

                    try {
                        $id = (int)$_POST['iddora'];
                        $jml = (int)$_POST['jmlstok'];
                        $userId = (int)$_POST['userid'];

                        if ($_POST['action'] == 'edit'){
                            $result = $this->model('Dorayaki_model')->changeStokDorayaki($id, $jml);

                            if ($result != 1){
                                $data['error'] = true;
                                $data['error-msg'] = 'perubahan gagal';
                                echo json_encode($data);
                            }
                            else{
                                $data['error'] = false;
                                echo json_encode($data);
                            }
                        }
                        else if ($_POST['action'] == 'buy'){
                            $result = $this->model('Dorayaki_model')->decreaseDorayaki($id, $jml);
                            if ($result == 1){
                                $result = $this->model('Pembelian_model')->insert($id, $userId, $jml);
                                if ($result == 1){
                                    $data['error'] = false;
                                    echo json_encode($data);
                                }
                                else {
                                    $data['error'] = true;
                                    $data['error-msg'] = 'pembelian gagal';
                                    echo json_encode($data);
                                }
                            }
                            else{
                                $data['error'] = true;
                                $data['error-msg'] = 'pembelian gagal';
                                echo json_encode($data);
                            }
                        }
                        else{
                            $data['error'] = true;
                            $data['error-msg'] = 'action error';
                            echo json_encode($data);
                        }

                        
                    } catch (Exception $e) {
                        $data['error'] = true;
                        $data['error-msg'] = $e->getMessage();
                        echo json_encode($data);
                    }                    
                }
                
            }
            else{
                $data['error'] = true;
                $data['error-msg'] = 'action error';
                echo json_encode($data);
            }
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['username'])){
            header('Location: ' . BASEURL);
            exit;
        }

        if (!isset($_POST['delete'])){
            header('Location: ' . BASEURL);
        }
        else{
            $id = $_POST['id'];

            $result = $this->model('Dorayaki_model')->deleteDorayaki($id);
            if ($result == 1){
                Flasher::setFlash(true, 'Dorayaki berhasil dihapus');
                header('Location: ' . BASEURL);
                exit;
            }
            else{
                Flasher::setFlash(false, 'Dorayaki gagal dihapus');
            }

            header('Location: ' . BASEURL . '/dorayaki/' . $id);
            exit;
        }
    }
}