<?php 

class Pembelian_model {
    private $table = 'pembelian';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($dorayaki_id, $user_id, $num)
    {
        $query = "INSERT INTO $this->table VALUES (NULL, :dorayaki_id, :user_id, :num, :timest)";
        $bind = [
            'dorayaki_id' => $dorayaki_id,
            'user_id' => $user_id,
            'num' => $num,
            'timest' => date('Y-m-d H:i:s',time())
        ];

        $this->db->query($query, $bind);
        $this->db->execute();
        return $this->db->rowAffected();
    }

    public function deleteAllDorayakiRecord($dorayaki_id)
    {
        $query = "DELETE FROM $this->table 
        WHERE dorayaki_id =:dorayaki_id";
        $bind = [
            'dorayaki_id' => $dorayaki_id
        ];

        $this->db->query($query, $bind);
        $this->db->execute();

        return $this->db->rowAffected();
    }

    public function getAllLogByUserId($userId)
    {
        $query = "SELECT nama, num * harga as total, num, timestamp
        FROM pembelian, dorayaki
        WHERE pembelian.dorayaki_id = dorayaki.id AND user_id=:userId";

        $bind = [
            'userId' => $userId
        ];

        $this->db->query($query, $bind);
        
        return $this->db->resultSet();
    }
}