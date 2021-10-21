<?php 

class Dorayaki extends Controller {

    public function index($id = null)
    {
        
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
            if ($url != 0){
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
}