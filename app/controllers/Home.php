<?php  

class Home extends Controller{

    private $nDorayakiInOnePage = 10;

    public function index($arg = null)
    {
        if (is_null($arg)){
            $this->page();
        }
        else {
            // TODO: Page not found harusnya
            $this->page();
        }
    }

    public function page($p=0)
    {
        try {
            $p = (int)$p;
            if ($p < 0) $p = 0; 
        }  
        catch(Exception $e) {
            $p = 0;
        }

        $offset = $p * $this->nDorayakiInOnePage;
        $limit = $this->nDorayakiInOnePage;

        $dorayaki = $this->model('Dorayaki_model')->getNDorayaki($limit, $offset);
        $numOfDorayaki = $this->model('Dorayaki_model')->getNumOfDorayaki()["count(id)"];

        $first = ($p == 0);
        $last = ($offset + count($dorayaki) >= (int)$numOfDorayaki);

        $data = [
            'title' => 'Dashboard',
            'isAdmin' => false,
            'username' => 'Budy',
            'dorayaki' => $dorayaki,
            'page' => $p,
            'first' => $first,
            'last' => $last
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }

}