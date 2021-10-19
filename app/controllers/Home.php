<?php  

class Home extends Controller{

    private $nDorayakiInOnePage = 10;

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'isAdmin' => false,
            'username' => 'Budy'
        ];

        $result = $this->getdorayakipage(0);
        $data['dorayaki'] = $result['dorayaki'];
        $data['page'] = $result['page'];
        $data['first'] = $result['first'];
        $data['last'] = $result['last'];
        $data['query'] = '';

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }

    public function getdorayakipage($p, $query='')
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

        $dorayaki = $this->model('Dorayaki_model')->getNDorayakiSortedFilter($limit, $offset, true, $query);
        $numOfDorayaki = $this->model('Dorayaki_model')->getNumOfDorayakiFilter($query)["count(id)"];

        $first = ($p == 0);
        $last = ($offset + count($dorayaki) >= (int)$numOfDorayaki);

        $data = [
            'dorayaki' => $dorayaki,
            'page' => $p,
            'first' => $first,
            'last' => $last
        ];

        return $data;
    }

    public function searchdorayaki($query, $page)
    {
        if ($query == 'null') $query = '';
        $result = $this->getdorayakipage($page, $query);
        echo json_encode($result);
    }

}