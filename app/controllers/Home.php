<?php  

class Home extends Controller{

    private $nDorayakiInOnePage = 10;

    public function index($page = 0)
    {
        try {
            $page = (int)$page;
            if ($page < 0) $page = 0; 
        }  
        catch(Exception $e) {
            $page = 0;
        }

        $offset = $page * $this->nDorayakiInOnePage;
        $limit = $this->nDorayakiInOnePage;

        $dorayaki = $this->model('Dorayaki_model')->getNDorayaki($limit, $offset);
        $numOfDorayaki = $this->model('Dorayaki_model')->getNumOfDorayaki()["count(id)"];

        $first = ($page == 0);
        $last = ($offset + count($dorayaki) >= (int)$numOfDorayaki);

        $data = [
            'title' => 'Dashboard',
            'isAdmin' => false,
            'username' => 'Budy',
            'dorayaki' => $dorayaki,
            'page' => $page,
            'first' => $first,
            'last' => $last
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }

}