<?php
class Blog {
    public $id;
    public $uid;
    public $title;
    public $photoName;
    public $text;
    public $createdAt;
    private static $pdo;

    public function __construct()
    {
        self::$pdo = require_once realpath($_SERVER["DOCUMENT_ROOT"]).'\metak\DAL\SqlDbContext.php';
    }

    function add(){
        $this->uid = uniqid();
        $this->createdAt = date('d-m-Y H:i:s');
        $sql = "INSERT INTO Blogs(uid, title, photoName, text, createdAt) VALUES(:uid, :title, :photoName, :text, :createdAt)";
        $statement = self::$pdo->prepare($sql);
        $statement->bindParam(':uid', $this->uid);
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':photoName', $this->photoName);
        $statement->bindParam(':text', $this->text);
        $statement->bindParam(':createdAt', $this->createdAt);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function get($page, $where = ''){
        $start = ($page - 1) * 5;
        $sql = 'SELECT * FROM Blogs';
        if($where != "")$sql .= " where ".$where;
        $sql .= " Limit ".$start.", 5";
        $statement = self::$pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOne($uid){
        $sql = "SELECT * FROM Blogs where uid = '".$uid."' Limit 1";
        $statement = self::$pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    function getPageCount($where = ''){
        $sql = 'SELECT Count(id) as c FROM Blogs';
        if($where != "")$sql .= " where ".$where;
        $statement = self::$pdo->query($sql);
        return ceil($statement->fetch(PDO::FETCH_ASSOC)['c'] / 5);
    }

    function update(){
        $sql = "Update Blogs set title = :title, photoName = :photoName, text = :text where uid = :uid";
        $statement = self::$pdo->prepare($sql);
        $statement->bindParam(':uid', $this->uid);
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':photoName', $this->photoName);
        $statement->bindParam(':text', $this->text);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function delete(){
        $sql = "Delete from Blogs where uid = :uid";
        $statement = self::$pdo->prepare($sql);
        $statement->bindParam(':uid', $this->uid);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}
return new Blog();