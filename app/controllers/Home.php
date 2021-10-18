<?php  

class Home extends Controller{

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'isAdmin' => true,
            'username' => 'Budy'
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }

}