<?php 

class Dorayaki_model {
    private $table = 'dorayaki';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDorayaki(){
    	$this->db->query('SELECT * FROM dorayaki');
    	$result = $this->db->resultSet();
    	return $result;
    }

    public function getDorayakiByID($ID){
    	$query = "SELECT * FROM $this->table WHERE ID=:ID";
    	$bind = ['ID'=>$ID];
    	$this->db->query($query, $bind);
    	$result = $this->db->single();
    	return $result;
    }

    public function getNDorayaki($n, $offset=0)
    {
        $query = "SELECT * FROM $this->table LIMIT $n OFFSET $offset";
        $this->db->query($query);
        $result = $this->db->resultSet();
        return $result;        
    }

    public function getNumOfDorayaki()
    {
        $query = "SELECT count(id) FROM $this->table";
        $this->db->query($query);
        $result = $this->db->single();
        return $result;  
    }
}