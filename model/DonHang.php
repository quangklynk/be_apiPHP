<?php
class DonHang
{
    private $conn;
    private $table = 'donhang';

    public $DiaChi;
    public $MaDH;
    public $MaUser;
    public $NgayGiao;
    public $NgayMuaHang;
    public $TongTien;
    public $TrangThai;

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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaDH = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaDH);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->DiaChi = $row['DiaChi'];
        $this->MaDH = $row['MaDH'];
        $this->MaUser = $row['MaUser'];
        $this->NgayGiao = $row['NgayGiao'];
        $this->NgayMuaHang = $row['NgayMuaHang'];
        $this->TongTien = $row['TongTien'];
        $this->TrangThai = $row['TrangThai'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            DiaChi = :DiaChi,
            MaUser = :MaUser,
            NgayGiao = :NgayGiao,
            NgayMuaHang = :NgayMuaHang,
            TongTien = :TongTien,
            TrangThai = :TrangThai';
        $stmt = $this->conn->prepare($query);

        $this->DiaChi = htmlspecialchars(strip_tags($this->DiaChi));
        $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
        $this->NgayGiao = htmlspecialchars(strip_tags($this->NgayGiao));
        $this->NgayMuaHang = htmlspecialchars(strip_tags($this->NgayMuaHang));
        $this->TongTien = htmlspecialchars(strip_tags($this->TongTien));
        $this->TrangThai = htmlspecialchars(strip_tags($this->TrangThai));

        $stmt->bindParam(':DiaChi', $this->DiaChi);
        $stmt->bindParam(':MaUser', $this->MaUser);
        $stmt->bindParam(':NgayGiao', $this->NgayGiao);
        $stmt->bindParam(':NgayMuaHang', $this->NgayMuaHang);
        $stmt->bindParam(':TongTien', $this->TongTien);
        $stmt->bindParam(':TrangThai', $this->TrangThai);

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
            DiaChi = :DiaChi,
            MaUser = :MaUser,
            NgayGiao = :NgayGiao,
            NgayMuaHang = :NgayMuaHang,
            TongTien = :TongTien,
            TrangThai = :TrangThai
        WHERE
            MaDH = :MaDH';

        $stmt = $this->conn->prepare($query);

        $this->DiaChi = htmlspecialchars(strip_tags($this->DiaChi));
        $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
        $this->NgayGiao = htmlspecialchars(strip_tags($this->NgayGiao));
        $this->NgayMuaHang = htmlspecialchars(strip_tags($this->NgayMuaHang));
        $this->TongTien = htmlspecialchars(strip_tags($this->TongTien));
        $this->TrangThai = htmlspecialchars(strip_tags($this->TrangThai));
        $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));

        $stmt->bindParam(':DiaChi', $this->DiaChi);
        $stmt->bindParam(':MaUser', $this->MaUser);
        $stmt->bindParam(':NgayGiao', $this->NgayGiao);
        $stmt->bindParam(':NgayMuaHang', $this->NgayMuaHang);
        $stmt->bindParam(':TongTien', $this->TongTien);
        $stmt->bindParam(':TrangThai', $this->TrangThai);
        $stmt->bindParam(':MaDH', $this->MaDH);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function updateStatus()
    {
        $query = 'UPDATE ' . $this->table . ' 
        SET
            TrangThai = :TrangThai
        WHERE
            MaDH = :MaDH';

        $stmt = $this->conn->prepare($query);

        $this->TrangThai = htmlspecialchars(strip_tags($this->TrangThai));
        $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));

        $stmt->bindParam(':TrangThai', $this->TrangThai);
        $stmt->bindParam(':MaDH', $this->MaDH);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function updateDeliveryDate()
    {
        $query = 'UPDATE ' . $this->table . ' 
        SET
            NgayGiao = :NgayGiao
        WHERE
            MaDH = :MaDH';

        $stmt = $this->conn->prepare($query);

        $this->NgayGiao = htmlspecialchars(strip_tags($this->NgayGiao));
        $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));

        $stmt->bindParam(':NgayGiao', $this->NgayGiao);
        $stmt->bindParam(':MaDH', $this->MaDH);
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
            MaDH = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaDH);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
