<?php
class Role
{
    private $conn;
    private $table = 'role';

    public $MaRole;
    public $Ten;

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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaRole = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->MaRole = $row['MaRole'];
        $this->Ten = $row['Ten'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
            Ten = :Ten';
        $stmt = $this->conn->prepare($query);
        $this->Ten = htmlspecialchars(strip_tags($this->Ten));

        $stmt->bindParam(':Ten', $this->Ten);
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
            Ten = :Ten
        WHERE
            MaRole = :MaRole';

        $stmt = $this->conn->prepare($query);

        $this->Ten = htmlspecialchars(strip_tags($this->Ten));
        $this->MaRole = htmlspecialchars(strip_tags($this->MaRole));

        $stmt->bindParam(':Ten', $this->Ten);
        $stmt->bindParam(':MaRole', $this->MaRole);
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
            MaRole = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
