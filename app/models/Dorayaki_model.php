<?php 

class Dorayaki_model {
    private $table = 'dorayaki';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDorayaki(){
    	$this->db->query('select * from dorayaki');
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
}