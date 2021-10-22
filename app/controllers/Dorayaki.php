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
        $this->view('templates/header', $data);
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
                    Flasher::setFlash('Dorayaki gagal ditambahkan!!');
                } 
                else{
                    Flasher::setFlash('Dorayaki berhasil ditambahkan');
                }
            }
            else{
                Flasher::setFlash('Gambar Error!!');
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
            $result = $this->model('Dorayaki_model')->updateStok($id, $jml);
            die;
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

    public function ubah()
    {
        
    }
}