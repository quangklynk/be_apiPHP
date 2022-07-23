<?php
class User
{
    private $conn;
    private $table = 'taikhoan';

    public $LoaiTK;
    public $MatKhau;
    public $TenTK;
    public $TinhTrang;

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

    // public function read_item()
    // {
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE MaUser = ? LIMIT 0,1';

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindParam(1, $this->MaUser);

    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $this->AnhChanDung = $row['AnhChanDung'];
    //     $this->DiaChi = $row['DiaChi'];
    //     $this->Email = $row['Email'];
    //     $this->GioiTinh = $row['GioiTinh'];
    //     $this->HoTen = $row['HoTen'];
    //     $this->MaRole = $row['MaRole'];
    //     $this->MatKhau = $row['MatKhau'];
    //     $this->MaUser = $row['MaUser'];
    //     $this->NgaySinh = $row['NgaySinh'];
    //     $this->SDT = $row['SDT'];
    //     $this->TKNH = $row['TKNH'];
    //     $this->token = $row['token'];
    // }

    // public function create()
    // {
    //     $query = 'INSERT INTO ' . $this->table . ' 
    //     SET
    //         AnhChanDung = :AnhChanDung,
    //         DiaChi = :DiaChi,
    //         Email = :Email,
    //         GioiTinh = :GioiTinh,
    //         HoTen = :HoTen,
    //         MaRole = :MaRole,
    //         MatKhau = :Ten,
    //         NgaySinh = :NgaySinh,
    //         SDT = :SDT,
    //         TKNH = :TKNH,
    //         token = :token';
    //     $stmt = $this->conn->prepare($query);

    //     $this->AnhChanDung = htmlspecialchars(strip_tags($this->AnhChanDung));
    //     $this->DiaChi = htmlspecialchars(strip_tags($this->DiaChi));
    //     $this->Email = htmlspecialchars(strip_tags($this->Email));
    //     $this->GioiTinh = htmlspecialchars(strip_tags($this->GioiTinh));
    //     $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
    //     $this->MaRole = htmlspecialchars(strip_tags($this->MaRole));
    //     $this->MatKhau = htmlspecialchars(strip_tags($this->MatKhau));
    //     $this->NgaySinh = htmlspecialchars(strip_tags($this->NgaySinh));
    //     $this->SDT = htmlspecialchars(strip_tags($this->SDT));
    //     $this->TKNH = htmlspecialchars(strip_tags($this->TKNH));
    //     $this->token = htmlspecialchars(strip_tags($this->token));

    //     $stmt->bindParam(':AnhChanDung', $this->AnhChanDung);
    //     $stmt->bindParam(':DiaChi', $this->DiaChi);
    //     $stmt->bindParam(':Email', $this->Email);
    //     $stmt->bindParam(':GioiTinh', $this->GioiTinh);
    //     $stmt->bindParam(':HoTen', $this->HoTen);
    //     $stmt->bindParam(':MaRole', $this->MaRole);
    //     $stmt->bindParam(':MatKhau', $this->MatKhau);
    //     $stmt->bindParam(':NgaySinh', $this->NgaySinh);
    //     $stmt->bindParam(':SDT', $this->SDT);
    //     $stmt->bindParam(':TKNH', $this->TKNH);
    //     $stmt->bindParam(':token', $this->token);

    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // public function register()
    // {
    //     $query = 'INSERT INTO ' . $this->table . ' 
    //     SET
    //         Email = :Email,
    //         HoTen = :HoTen,
    //         MaRole = :MaRole,
    //         MatKhau = :MatKhau,
    //         SDT = :SDT';
    //     $stmt = $this->conn->prepare($query);

    //     $this->Email = htmlspecialchars(strip_tags($this->Email));
    //     $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
    //     $this->MaRole = htmlspecialchars(strip_tags($this->MaRole));
    //     $this->MatKhau = htmlspecialchars(strip_tags($this->MatKhau));
    //     $this->SDT = htmlspecialchars(strip_tags($this->SDT));

    //     $stmt->bindParam(':Email', $this->Email);
    //     $stmt->bindParam(':HoTen', $this->HoTen);
    //     $stmt->bindParam(':MaRole', $this->MaRole);
    //     $stmt->bindParam(':MatKhau', $this->MatKhau);
    //     $stmt->bindParam(':SDT', $this->SDT);
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // public function update()
    // {
    //     $query = 'UPDATE ' . $this->table . ' 
    //     SET
    //         AnhChanDung = :AnhChanDung,
    //         DiaChi = :DiaChi,
    //         Email = :Email,
    //         GioiTinh = :GioiTinh,
    //         HoTen = :HoTen,
    //         MaRole = :MaRole,
    //         MatKhau = :Ten,
    //         NgaySinh = :NgaySinh,
    //         SDT = :SDT,
    //         TKNH = :TKNH,
    //         token = :token
    //     WHERE
    //         MaUser = :MaUser';

    //     $stmt = $this->conn->prepare($query);

    //     $this->AnhChanDung = htmlspecialchars(strip_tags($this->AnhChanDung));
    //     $this->DiaChi = htmlspecialchars(strip_tags($this->DiaChi));
    //     $this->Email = htmlspecialchars(strip_tags($this->Email));
    //     $this->GioiTinh = htmlspecialchars(strip_tags($this->GioiTinh));
    //     $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
    //     $this->MaRole = htmlspecialchars(strip_tags($this->MaRole));
    //     $this->MatKhau = htmlspecialchars(strip_tags($this->MatKhau));
    //     $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
    //     $this->NgaySinh = htmlspecialchars(strip_tags($this->NgaySinh));
    //     $this->SDT = htmlspecialchars(strip_tags($this->SDT));
    //     $this->TKNH = htmlspecialchars(strip_tags($this->TKNH));
    //     $this->token = htmlspecialchars(strip_tags($this->token));

    //     $stmt->bindParam(':AnhChanDung', $this->AnhChanDung);
    //     $stmt->bindParam(':DiaChi', $this->DiaChi);
    //     $stmt->bindParam(':Email', $this->Email);
    //     $stmt->bindParam(':GioiTinh', $this->GioiTinh);
    //     $stmt->bindParam(':HoTen', $this->HoTen);
    //     $stmt->bindParam(':MaRole', $this->MaRole);
    //     $stmt->bindParam(':MatKhau', $this->MatKhau);
    //     $stmt->bindParam(':MaUser', $this->MaUser);
    //     $stmt->bindParam(':NgaySinh', $this->NgaySinh);
    //     $stmt->bindParam(':SDT', $this->SDT);
    //     $stmt->bindParam(':TKNH', $this->TKNH);
    //     $stmt->bindParam(':token', $this->token);
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // public function delete()
    // {
    //     $query = 'DELETE FROM ' . $this->table . ' 
    //     WHERE
    //         MaUser = ?';

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindParam(1, $this->MaUser);

    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     printf("Error: %s.\n", $stmt->error);
    //     return false;
    // }

    // public function getByEmail()
    // {
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE Email = ? LIMIT 0,1';

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindParam(1, $this->Email);

    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $this->MaUser = $row['MaUser'];
    // }
    
    public function login() {
        // check TenTK
        $query = 'SELECT * FROM ' . $this->table . ' WHERE TenTK = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->TenTK);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($row['TenTK'])) {
            return false;
        }

        //check MK
        if ($row['MatKhau'] != $this->MatKhau) {
            return false;
        }

        return true;
    }

    public function checkTenTK() // SDT - MatKhau
    {
        // check TenTK
        $query = 'SELECT * FROM ' . $this->table . ' WHERE TenTK = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->TenTK);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($row['TenTK'])) {
            return false;
        }

        return true;
    }

    // public function sloveTokenLogout() {
    //     // check token
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE token = ? LIMIT 0,1';
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $this->token);
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if (empty($row['MaUser'])) {
    //         return false;
    //     }

    //     $this->MaUser = $row['MaUser']; // update
    //     $newToken = '';

    //     $query1 = 'UPDATE ' . $this->table . ' 
    //     SET
    //         token = :token
    //     WHERE
    //         MaUser = :MaUser';

    //     $stmt1 = $this->conn->prepare($query1);

    //     $this->MaUser = htmlspecialchars(strip_tags($this->MaUser));
    //     $this->token = htmlspecialchars(strip_tags($newToken));

    //     $stmt1->bindParam(':MaUser', $this->MaUser);
    //     $stmt1->bindParam(':token', $newToken);
    //     if ($stmt1->execute()) {
    //         return true;
    //     }

    //     printf("Error: %s.\n", $stmt1->error);

    //     return false;
    // }

    // public function checkAdmin() {
    //     // check token
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE token = ? LIMIT 0,1';
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $this->token);
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if (empty($row['MaUser'])) {
    //         return false;
    //     }

    //     if ($row['MaRole'] == 1) {
    //         return true;
    //     }

    //     return false;
    // }

    // public function checkShop() {
    //     // check token
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE token = ? LIMIT 0,1';
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $this->token);
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if (empty($row['MaUser'])) {
    //         return false;
    //     }

    //     if ($row['MaRole'] == 2) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function checkEndUser() {
    //     // check token
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE token = ? LIMIT 0,1';
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $this->token);
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if (empty($row['MaUser'])) {
    //         return false;
    //     }

    //     if ($row['MaRole'] == 3) {
    //         return true;
    //     }

    //     return false;
    // }

    // public function getListUserByMarole()
    // {

    //     if ($this->MaRole == 3) {
    //         $query = 'SELECT u.*, kh.CMND FROM ' . $this->table . ' as u,' . $this->table_khachhang . ' as kh' . ' WHERE u.MaUser = kh.MaUser and u.MaRole = ? LIMIT 0,1';
    //     }

    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE MaRole = ? LIMIT 0,1';

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindParam(1, $this->MaRole);

    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $this->AnhChanDung = $row['AnhChanDung'];
    //     $this->DiaChi = $row['DiaChi'];
    //     $this->Email = $row['Email'];
    //     $this->GioiTinh = $row['GioiTinh'];
    //     $this->HoTen = $row['HoTen'];
    //     $this->MaRole = $row['MaRole'];
    //     $this->MaUser = $row['MaUser'];
    //     $this->NgaySinh = $row['NgaySinh'];
    //     $this->SDT = $row['SDT'];
    //     $this->TKNH = $row['TKNH'];

    //     if ($this->MaRole == 3) {
    //         $this->TKNH = $row['TKNH'];
    //     }

    // }

    // public function findUserByToken() {
    //     // check token
    //     $query = 'SELECT * FROM ' . $this->table . ' WHERE token = ? LIMIT 0,1';
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $this->token);
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if (empty($row['MaUser'])) {
    //         return false;
    //     }

    //     $this->MaUser = $row['MaUser'];
    //     $this->MaRole = $row['MaRole'];

    //     return true;
    // }

}
