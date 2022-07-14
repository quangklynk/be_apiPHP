<?php
class CuaHang
{
    private $conn;
    private $table = 'cuahang';

    public $LoaiCuaHang;
    public $MaCH;
    public $MaUser;
    public $Ten;
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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaCH = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaCH);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->LoaiCuaHang = $row['LoaiCuaHang'];
        $this->MaCH = $row['MaCH'];
        $this->MaUser = $row['MaUser'];
        $this->Ten = $row['Ten'];
        $this->TrangThai = $row['TrangThai'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            LoaiCuaHang = :LoaiCuaHang,
            MaUser = :MaUser,
            Ten = :Ten,
            TrangThai = :TrangThai';
        $stmt = $this->conn->prepare($query);

        $this->LoaiCuaHang = htmlspecialchars(strip_tags($this->LoaiCuaHang));
        $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
        $this->Ten = htmlspecialchars(strip_tags($this->Ten));
        $this->TrangThai = htmlspecialchars(strip_tags($this->TrangThai));

        $stmt->bindParam(':LoaiCuaHang', $this->LoaiCuaHang);
        $stmt->bindParam(':MaUser', $this->MaUser);
        $stmt->bindParam(':Ten', $this->Ten);
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
            LoaiCuaHang = :LoaiCuaHang,
            MaUser = :MaUser,
            Ten = :Ten,
            TrangThai = :TrangThai
        WHERE
            MaCH = :MaCH';

        $stmt = $this->conn->prepare($query);

        $this->LoaiCuaHang = htmlspecialchars(strip_tags($this->LoaiCuaHang));
        $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
        $this->Ten = htmlspecialchars(strip_tags($this->Ten));
        $this->TrangThai = htmlspecialchars(strip_tags($this->TrangThai));
        $this->MaCH = htmlspecialchars(strip_tags($this->MaCH));

        $stmt->bindParam(':LoaiCuaHang', $this->LoaiCuaHang);
        $stmt->bindParam(':MaUser', $this->MaUser);
        $stmt->bindParam(':Ten', $this->Ten);
        $stmt->bindParam(':TrangThai', $this->TrangThai);
        $stmt->bindParam(':MaCH', $this->MaCH);
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
            MaCH = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaCH);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
