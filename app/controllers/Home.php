<?php  

class Home extends Controller{

    public function index()
    {
        $dorayaki = $this->model('Dorayaki_model')->getAllDorayaki();

        $data = [
            'title' => 'Dashboard',
            'isAdmin' => true,
            'username' => 'Budy',
            'dorayaki' => $dorayaki
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }

}