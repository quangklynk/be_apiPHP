<?php
class ChiTietDonHang
{
    private $conn;
    private $table = 'chitietdonhang';

    public $GiaTien;
    public $MaCTDH;
    public $MaDH;
    public $MaSP;
    public $SoLuong;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT ctdh.*, sp.TenSP FROM ' . $this->table . ' as ctdh, '. $this->table_sp.' as sp'.' WHERE ctdh.MaSP = sp.MaSP';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_item()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaCTDH = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaCTDH);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->GiaTien = $row['GiaTien'];
        $this->MaCTDH = $row['MaCTDH'];
        $this->MaDH = $row['MaDH'];
        $this->MaSP = $row['MaSP'];
        $this->SoLuong = $row['SoLuong'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            GiaTien = :GiaTien
            MaDH = :MaDH
            MaSP = :MaSP
            SoLuong = :SoLuong';
        $stmt = $this->conn->prepare($query);

        $this->GiaTien = htmlspecialchars(strip_tags($this->GiaTien));
        $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));
        $this->MaSP = htmlspecialchars(strip_tags($this->MaSP));
        $this->SoLuong = htmlspecialchars(strip_tags($this->SoLuong));

        $stmt->bindParam(':GiaTien', $this->GiaTien);
        $stmt->bindParam(':MaDH', $this->MaDH);
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
            GiaTien = :GiaTien
            MaDH = :MaDH
            MaSP = :MaSP
            SoLuong = :SoLuong
        WHERE
            MaCTDH = :MaCTDH';

        $stmt = $this->conn->prepare($query);

        $this->GiaTien = htmlspecialchars(strip_tags($this->GiaTien));
        $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));
        $this->MaSP = htmlspecialchars(strip_tags($this->MaSP));
        $this->SoLuong = htmlspecialchars(strip_tags($this->SoLuong));
        $this->MaCTDH = htmlspecialchars(strip_tags($this->MaCTDH));

        $stmt->bindParam(':GiaTien', $this->GiaTien);
        $stmt->bindParam(':MaDH', $this->MaDH);
        $stmt->bindParam(':MaSP', $this->MaSP);
        $stmt->bindParam(':SoLuong', $this->SoLuong);
        $stmt->bindParam(':MaCTDH', $this->MaCTDH);
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
            MaCTDH = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaCTDH);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
