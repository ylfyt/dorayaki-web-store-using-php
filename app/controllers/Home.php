<?php  

class Home extends Controller{

    private $nDorayakiInOnePage = 10;

    public function index()
    {
        if(!isset($_SESSION['username'])){
            header('Location:'. BASEURL.'/user/signin');
            exit;
        }

        $data = [
            'title' => 'Dashboard',
            'is-admin' => $_SESSION['is-admin'],
            'username' => $_SESSION['username'],
            'dashboard' => true
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

    public function history(){
        if (!isset($_SESSION['user-id'])){
            header('Location: ' . BASEURL . '/user/signin');
            exit;
        }

        $data = [
            'title' => 'Riwayat',
            'is-admin' => $_SESSION['is-admin'],
            'username' => $_SESSION['username']
        ];

        if (!$_SESSION['is-admin']){

            $userId = $_SESSION['user-id'];

            $logs = $this->model('Pembelian_model')->getAllLogByUserId($userId);

            $data['history'] = $logs;

            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('home/history_buy', $data);
            $this->view('templates/footer', $data);
        }

    }


}