<?php
class Client
{
  public $id = null;
  public $name = null;
  public $subcategory = null;

  public function __construct($data=array()) {
    if (isset($data['id'])) $this->id = (int) $data['id'];
    if (isset($data['name'])) $this->name = $data['name'];
    if (isset($data['subcategory'])) $this->subcategory = (int) $data['subcategory'];
  }

  public function storeFormValues ($params) {
    // Store all the parameters
    $this->__construct($params);
  }

  public static function getListOfClients($key) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM clients WHERE subcategory = $key";

    $st = $conn->prepare( $sql );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $client = new Client( $row );
      $list[] = $client;
    }

    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query($sql)->fetch();
    $conn = null;

    return (array("results"=>$list,"totalRows"=>$totalRows[0]));

  }

  public function insert() {
    // Does the Client object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Portfolio::insert(): Attempt to insert an Portfolio object that already has its ID property set (to $this->id).", E_USER_ERROR );
    // Insert the Client
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO clients ( name, subcategory ) VALUES ( :name, :subcategory )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":subcategory", $this->subcategory, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
    return;
  }

  public static function delete($key) {
    // Delete the client form the database
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM clients WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $key, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }






}
 ?>
