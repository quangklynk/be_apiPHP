<?php
include_once '../../config/config.inc';
include_once 'DichVu.php';
class DonHang
{
    private $conn;
    private $table = 'donhang';

    public $DiaChi;
    public $DienThoai;
    public $GhiChu;
    public $MaDangKy;
    public $MaDH;
    public $MaDV;
    public $SoLuong;
    public $TenKH;
    public $ThanhTien;
    public $ThoiGianBD;
    public $ThoiGianKT;
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
        $this->DienThoai = $row['DienThoai'];
        $this->GhiChu = $row['GhiChu'];
        $this->MaDangKy = $row['MaDangKy'];
        $this->MaDH = $row['MaDH'];
        $this->MaDV = $row['MaDV'];
        $this->SoLuong = $row['SoLuong'];
        $this->TenKH = $row['TenKH'];
        $this->ThanhTien = $row['ThanhTien'];
        $this->ThoiGianBD = $row['ThoiGianBD'];
        $this->ThoiGianKT = $row['ThoiGianKT'];
        $this->TrangThai = $row['TrangThai'];
    }

    public function generateRandomString($length = 10, $type = 0)
    {
        if ($type == 1) {
            $characters = '0123456789';
        } elseif ($type == 2) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        }

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            DiaChi = :DiaChi,
            DienThoai = :DienThoai,
            GhiChu = :GhiChu,
            MaDangKy = :MaDangKy,
            MaDV = :MaDV,
            SoLuong = :SoLuong,
            TenKH = :TenKH,
            ThanhTien = :ThanhTien,
            ThoiGianBD = :ThoiGianBD,
            ThoiGianKT = :ThoiGianKT,;
            TrangThai = :TrangThai';
        $stmt = $this->conn->prepare($query);

        $database = new Database();
        $db = $database->connect();

        $dv = new DichVu($db);
        $dv->MaDV = $this->MaDV;
        $dv->read_item();

        $randomString = $this->generateRandomString(20, 2);
        $thanhTien = $this->SoLuong*$dv->DonGia;
        $trangThai = 'DAKHOITAO';

        $this->DiaChi = htmlspecialchars(strip_tags($this->DiaChi));
        $this->DienThoai = htmlspecialchars(strip_tags($this->DienThoai));
        $this->GhiChu = htmlspecialchars(strip_tags($this->GhiChu));
        $this->MaDangKy = htmlspecialchars(strip_tags($randomString));
        $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));
        $this->MaDV = htmlspecialchars(strip_tags($this->MaDV));
        $this->SoLuong = htmlspecialchars(strip_tags($this->SoLuong));
        $this->TenKH = htmlspecialchars(strip_tags($this->TenKH));
        $this->ThanhTien = htmlspecialchars(strip_tags($thanhTien));
        $this->ThoiGianBD = htmlspecialchars(strip_tags($this->ThoiGianBD));
        $this->ThoiGianKT = htmlspecialchars(strip_tags($this->ThoiGianKT));
        $this->TrangThai = htmlspecialchars(strip_tags($trangThai));

        $stmt->bindParam(':DiaChi', $this->DiaChi);
        $stmt->bindParam(':DienThoai', $this->DienThoai);
        $stmt->bindParam(':GhiChu', $this->GhiChu);
        $stmt->bindParam(':MaDangKy', $randomString);
        $stmt->bindParam(':MaDH', $this->MaDH);
        $stmt->bindParam(':MaDV', $this->MaDV);
        $stmt->bindParam(':SoLuong', $this->SoLuong);
        $stmt->bindParam(':TenKH', $this->TenKH);
        $stmt->bindParam(':ThanhTien', $thanhTien);
        $stmt->bindParam(':ThoiGianBD', $this->ThoiGianBD);
        $stmt->bindParam(':ThoiGianKT', $this->ThoiGianKT);
        $stmt->bindParam(':TrangThai', $trangThai);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function updateByCustomer() /// sdt, tg, diachi, id
    {
        if ($this->TrangThai == 'DAKHOITAO') {
            $query = 'UPDATE ' . $this->table . ' 
                SET
                    DienThoai = :DienThoai,
                    ThoiGianBD = :ThoiGianBD,
                    DiaChi = :DiaChi
                WHERE
                    MaDH = :MaDH';

            $stmt = $this->conn->prepare($query);

            $this->DienThoai = htmlspecialchars(strip_tags($this->DienThoai));
            $this->ThoiGianBD = htmlspecialchars(strip_tags($this->ThoiGianBD));
            $this->DiaChi = htmlspecialchars(strip_tags($this->DiaChi));
            $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));

            $stmt->bindParam(':DienThoai', $this->DienThoai);
            $stmt->bindParam(':ThoiGianBD', $this->ThoiGianBD);
            $stmt->bindParam(':DiaChi', $this->DiaChi);
            $stmt->bindParam(':MaDH', $this->MaDH);
            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function cancelByCustomerAndAdmin() /// id
    {
        if ($this->TrangThai == 'DAKHOITAO') {
            $query = 'UPDATE ' . $this->table . ' 
                SET
                    TrangThai = :TrangThai
                WHERE
                    MaDH = :MaDH';

            $stmt = $this->conn->prepare($query);

            $status = 'HUY';

            $this->TrangThai = htmlspecialchars(strip_tags($status));
            $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));

            $stmt->bindParam(':TrangThai', $status);
            $stmt->bindParam(':MaDH', $this->MaDH);
            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function updateStatuByAdmin() // id, trang thai (if HOANTAT update thoi gian ket thuc)
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

    // public function updateDeliveryDate()
    // {
    //     $query = 'UPDATE ' . $this->table . ' 
    //     SET
    //         NgayGiao = :NgayGiao
    //     WHERE
    //         MaDH = :MaDH';

    //     $stmt = $this->conn->prepare($query);

    //     $this->NgayGiao = htmlspecialchars(strip_tags($this->NgayGiao));
    //     $this->MaDH = htmlspecialchars(strip_tags($this->MaDH));

    //     $stmt->bindParam(':NgayGiao', $this->NgayGiao);
    //     $stmt->bindParam(':MaDH', $this->MaDH);
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

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
