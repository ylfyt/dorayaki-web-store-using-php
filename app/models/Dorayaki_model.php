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

    public function getNDorayakiSorted($n, $offset=0, $desc=true)
    {
        if ($desc){
            $query = "SELECT dorayaki.id as id, nama, harga, url, deskripsi, SUM(num) as total
            FROM dorayaki
            LEFT JOIN pembelian ON dorayaki.id = pembelian.dorayaki_id
            GROUP BY dorayaki.id
            ORDER BY total DESC
            LIMIT :n
            OFFSET :offset";
        }
        else{
            $query = "SELECT dorayaki.id as id, nama, harga, url, deskripsi, SUM(num) as total
            FROM dorayaki
            LEFT JOIN pembelian ON dorayaki.id = pembelian.dorayaki_id
            GROUP BY dorayaki.id
            ORDER BY total ASC
            LIMIT :n
            OFFSET :offset";
        }

        $bind = [
            'n' => $n,
            'offset' => $offset
        ];

        $this->db->query($query, $bind);
        $result = $this->db->resultSet();
        return $result;        
    }

    public function getNDorayakiSortedFilter($n, $offset=0, $desc=true, $query)
    {
        if ($desc){
            $query = "SELECT dorayaki.id as id, nama, harga, url, deskripsi, SUM(num) as total
            FROM dorayaki
            LEFT JOIN pembelian ON dorayaki.id = pembelian.dorayaki_id
            WHERE nama LIKE '%$query%' OR deskripsi LIKE '%$query%'
            GROUP BY dorayaki.id
            ORDER BY total DESC
            LIMIT :n
            OFFSET :offset";
        }
        else{
            $query = "SELECT dorayaki.id as id, nama, harga, url, deskripsi, SUM(num) as total
            FROM dorayaki
            LEFT JOIN pembelian ON dorayaki.id = pembelian.dorayaki_id
            WHERE nama LIKE '%$query%' OR deskripsi LIKE '%$query%'
            GROUP BY dorayaki.id
            ORDER BY total ASC
            LIMIT :n
            OFFSET :offset";
        }

        $bind = [
            'n' => $n,
            'offset' => $offset
        ];

        $this->db->query($query, $bind);
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

    public function getNumOfDorayakiFilter($q)
    {
        $query = "SELECT count(id) 
        FROM $this->table
        WHERE nama LIKE '%$q%' OR deskripsi LIKE '%$q%'";
        $this->db->query($query);
        $result = $this->db->single();
        return $result;  
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table VALUES
        (NULL, :nama, :url, :deskripsi, :harga, :stok)";

        $bind = $data;

        $this->db->query($query, $bind);
        $this->db->execute();

        return $this->db->rowAffected();
    }

    public function getSoldDorayaki($id)
    {
        $query = "SELECT sum(num) as total FROM pembelian 
        WHERE dorayaki_id = $id GROUP BY dorayaki_id";

        $this->db->query($query);
        $result = $this->db->single();
        return $result;
    }

    public function deleteDorayaki($nama, $id)
    {
        $query = "DELETE FROM dorayaki 
        WHERE nama = $nama";

        // $query = "DELETE FROM perubahan 
        // WHERE Dorayaki_id = $id";

        $this->db->query($query);
        $result = $this->db->single();
        return $result;
    }

    public function decreaseDorayaki($nama, $jml)
    {
        $query = "UPDATE dorayaki
        SET stok = stok - $jml
        WHERE nama = $nama";

        $this->db->query($query);
        $result = $this->db->single();
        return $result;
    }

    public function changeStokDorayaki($nama, $jml)
    {
        $query = "UPDATE dorayaki
        SET stok = $jml
        WHERE nama = $nama";

        $this->db->query($query);
        $result = $this->db->single();
        return $result;
    }

    // public function test()
    // {
    //     $query = 'SELECT dorayaki.id as id, nama, harga, url, SUM(num) as total
    //     FROM dorayaki, pembelian 
    //     WHERE pembelian.dorayaki_id = dorayaki.id
    //     GROUP BY dorayaki.id
    //     ORDER BY total DESC
    //     LIMIT 10
    //     OFFSET 0';
    //     $this->db->query($query);
    //     $result = $this->db->resultSet();
    //     var_dump($result);
    //     die;
    // }
}