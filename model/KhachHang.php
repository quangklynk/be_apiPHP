<?php
class KhachHang
{
    private $conn;
    private $table = 'khachhang';

    public $CMND;
    public $MaKH;
    public $MaUser;

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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaKH = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaKH);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->CMND = $row['CMND'];
        $this->MaKH = $row['MaKH'];
        $this->MaUser = $row['MaUser'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            CMND = :CMND,
            MaUser = :MaUser';
        $stmt = $this->conn->prepare($query);

        $this->CMND = htmlspecialchars(strip_tags($this->CMND));
        $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));

        $stmt->bindParam(':CMND', $this->CMND);
        $stmt->bindParam(':MaUser', $this->MaUser);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' 
        SET
            CMND = :CMND,
            MaUser = :MaUser
        WHERE
            MaKH = :MaKH';

        $stmt = $this->conn->prepare($query);

        $this->CMND = htmlspecialchars(strip_tags($this->CMND));
        $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
        $this->MaKH = htmlspecialchars(strip_tags($this->MaKH));

        $stmt->bindParam(':CMND', $this->CMND);
        $stmt->bindParam(':MaUser', $this->MaUser);
        $stmt->bindParam(':MaKH', $this->MaKH);
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
            MaKH = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->MaKH);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
