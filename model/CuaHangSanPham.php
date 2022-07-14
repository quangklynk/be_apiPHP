<?php
class CuaHangSanPham
{
    private $conn;
    private $table = 'cuahangsanpham';

    public $ID;
    public $MaCH;
    public $MaSP;
    public $SoLuong;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_item()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ID = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->ID);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID = $row['ID'];
        $this->MaCH = $row['MaCH'];
        $this->MaSP = $row['MaSP'];
        $this->SoLuong = $row['SoLuong'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            MaCH = :MaCH,
            MaSP = :MaSP,
            SoLuong = :SoLuong';
        $stmt = $this->conn->prepare($query);

        $this->MaCH = htmlspecialchars(strip_tags($this->MaCH));
        $this->MaSP = htmlspecialchars(strip_tags($this->MaSP));
        $this->SoLuong = htmlspecialchars(strip_tags($this->SoLuong));

        $stmt->bindParam(':MaCH', $this->MaCH);
        $stmt->bindParam(':MaSP', $this->MaSP);
        $stmt->bindParam(':SoLuong', $this->SoLuong);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' 
        SET
            MaCH = :MaCH,
            MaSP = :MaSP,
            SoLuong = :SoLuong
        WHERE
            ID = :ID';

        $stmt = $this->conn->prepare($query);

        $this->MaCH = htmlspecialchars(strip_tags($this->MaCH));
        $this->MaSP = htmlspecialchars(strip_tags($this->MaSP));
        $this->SoLuong = htmlspecialchars(strip_tags($this->SoLuong));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(':MaCH', $this->MaCH);
        $stmt->bindParam(':MaSP', $this->MaSP);
        $stmt->bindParam(':SoLuong', $this->SoLuong);
        $stmt->bindParam(':ID', $this->ID);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' 
        WHERE
            ID = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->ID);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
