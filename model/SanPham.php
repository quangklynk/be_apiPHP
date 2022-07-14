<?php
class SanPham
{
    private $conn;
    private $table = 'sanpham';

    public $GiaSP;
    public $MaSP;
    public $MoTa;
    public $NgaySanXuat;
    public $TenSP;

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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaSP = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaSP);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->GiaSP = $row['GiaSP'];
        $this->MaSP = $row['MaSP'];
        $this->MoTa = $row['MoTa'];
        $this->NgaySanXuat = $row['NgaySanXuat'];
        $this->TenSP = $row['TenSP'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            GiaSP = :GiaSP
            MoTa = :MoTa
            NgaySanXuat = :NgaySanXuat
            TenSP = :TenSP';
        $stmt = $this->conn->prepare($query);

        $this->GiaSP = htmlspecialchars(strip_tags($this->GiaSP));
        $this->MoTa = htmlspecialchars(strip_tags($this->MoTa));
        $this->NgaySanXuat = htmlspecialchars(strip_tags($this->NgaySanXuat));
        $this->TenSP = htmlspecialchars(strip_tags($this->TenSP));

        $stmt->bindParam(':GiaSP', $this->GiaSP);
        $stmt->bindParam(':MoTa', $this->MoTa);
        $stmt->bindParam(':NgaySanXuat', $this->NgaySanXuat);
        $stmt->bindParam(':TenSP', $this->TenSP);

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
            GiaSP = :GiaSP
            MoTa = :MoTa
            NgaySanXuat = :NgaySanXuat
            TenSP = :TenSP
        WHERE
            MaSP = :MaSP';

        $stmt = $this->conn->prepare($query);

        $this->GiaSP = htmlspecialchars(strip_tags($this->GiaSP));
        $this->MaSP = htmlspecialchars(strip_tags($this->MaSP));
        $this->MoTa = htmlspecialchars(strip_tags($this->MoTa));
        $this->NgaySanXuat = htmlspecialchars(strip_tags($this->NgaySanXuat));
        $this->TenSP = htmlspecialchars(strip_tags($this->TenSP));

        $stmt->bindParam(':GiaSP', $this->GiaSP);
        $stmt->bindParam(':MaSP', $this->MaSP);
        $stmt->bindParam(':MoTa', $this->MoTa);
        $stmt->bindParam(':NgaySanXuat', $this->NgaySanXuat);
        $stmt->bindParam(':TenSP', $this->TenSP);
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
            MaSP = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaSP);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}