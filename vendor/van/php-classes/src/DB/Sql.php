<?php

namespace Van\DB;

class Sql
{

const HOSTNAME = "127.0.0.1";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "db_van";

private $conn;

public function __construct()
{
  $this->conn = new \PDO{
    "mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,
    Sql::USERNAME,
    Sql::PASSWORD);
  }
}

private function setParams($stmt, $params = array())
{
  foreach ($params as $key => $value) {
    $this->bindParam($stmt, $key, $value);
  }
}

private function bindParam($stmt, $key, $value)
{
  $stmt->bindParam($key,$value);
}

public function select($query,$params = array()):array
{
  $stmt = $this->conn->prepare($query);
  $this->setParams($stmt, $params);
  $stmt->execute;

  return $stmt->fetchAll(\PDO::FECTH_ASSOC);

}

public function query($query, $params = array())
{
  $stmt = $this->conn->prepare($query);
  $this->setParams($stmt,$params);
  $stmt->execute();

}

}


?>
