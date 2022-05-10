<?php
namespace Lib\Database;

class Mysql implements DatabaseContract {
  protected $db;
  protected static $instance;
  protected function __construct() {
    $this->db = mysqli_connect("host.docker.internal", "root", "NodeSol786", "rabani");
  }

  protected function __destruct() {
    $this->db->close();
  }

  static function getInstance() {
    if(!self::$instance) {
      self::$instance = new static;
    }

    return self::$instance;
  }

  function find($id, $table, $key) {
    $query = "SELECT * FROM {$table} WHERE {$key}='{$id}'";
    $result = $this->db->query($query);
    if($result->num_rows > 0) {
      return $result->fetch_row();
    }
  }

  function all($table) {
    $query = "SELECT * FROM {$table}";
    $result = $this->db->query($query);
    if($result->num_rows > 0) {
      $output = [];
      return $result->fetch_all(MYSQLI_ASSOC);
      /*while($row = $result->fetch_assoc()) {
        $output[] = $row;
      }*/
    }

    return $output;
  }

  function insert($table, $data) {
    $query = "INSERT INTO {$table} ";
    $data = $this->computeFieldsValues($data);
    $fields = implode(",", $data['fields']);
    $values = implode(",", $data['values']);
    $query .= " ({$fields}) VALUES {$values}";
    $this->db->query($query);
    return $this->db->insert_id;
  }

  function computeFieldsValues($data) {
    $fields = [];
    $values = [];
    if(isset($data[0]) && is_array($data[0])) {
      $fields = array_keys($data[0]);
      foreach($data as $row) {
        $values[] = "('" . implode("', '", array_values($data)) . "')";
      }
    } else {
      $fields = array_keys($data);
      $values[] = "('" . implode("', '", array_values($data)) . "')";
    }
    return ["fields" => $fields, "values" => $values];
  }
}
