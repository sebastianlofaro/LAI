<?php
/**
 *
 */
class Subcategory
{
  public $id = null;
  public $name = null;

  function __construct($data=array()) {
    if (isset($data['id'])) $this->id = (int) $data['id'];
    if (isset($data['name'])) $this->name = $data['name'];
  }

  public function storeFormValues ($params) {
    $this->__construct($params);
  }

  public static function topSubCat() {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT id FROM side_menu LIMIT 1";
    $st = $conn->prepare($sql);
    $st->execute();
    return $st->fetch();
  }

  public static function getList() {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM side_menu";

    $st = $conn->prepare($sql);
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $subcategory = new Subcategory($row);
      $list[] = $subcategory;
    }

    $conn = null;
    return (array("results"=>$list));
  }

  public function insert() {
    // Make sure the Subcategory doesnt already have an ID.
    if ( !is_null( $this->id ) ) trigger_error ( "Subcategory::insert(): Subcategory to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Subcategory
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO side_menu ( name ) VALUES ( :name )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }

  public static function delete($key) {

    //********** Delete the subcategory form the side menu **********
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM side_menu WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $key, PDO::PARAM_INT );
    $st->execute();
    $conn = null;

    //********** Delete all the images **********
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare( "SELECT imagePath FROM portfolio WHERE subcategory = :subCat" );
    $st->bindValue(":subCat", $key, PDO::PARAM_INT);
    $st->execute();
    $list = array();
    while ( $imagePath = $st->fetch() ) {
      unlink($imagePath[0]);
    }
    $conn = null;

    //********** Delete all the posts from the database **********
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM portfolio WHERE subcategory = :subCat" );
    $st->bindValue( ":subCat", $key, PDO::PARAM_INT );
    $st->execute();
    $conn = null;

  }


}
?>