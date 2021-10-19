<?php 

class Dorayaki extends Controller {

    public function index($id = null)
    {
        
    }

    public function getndorayakisortedfilter($query, $n, $offset)
    {
        if ($query == 'null'){
            $query = '';
        }
        $result = $this->model('Dorayaki_model')->getNDorayakiSortedFilter($n, $offset, true, $query);
        echo json_encode($result);
    }

}