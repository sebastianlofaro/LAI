<?php

/**
 * Class to handle articles
 */

class Article
{
  public $id = null;
  public $imagePath = null;
  public $title = null;
  public $services = null;
  public $content = null;
  public $personnel = null;
  public $contractAmount = null;
  public $completionDate = null;

  public function __construct($data=array()) {
    if (isset($data['id'])) $this->id = (int) $data['id'];
    if (isset($data['imagePath'])) $this->imagePath = $data['imagePath'];
    if (isset($data['title'])) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if (isset($data['services'])) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['services'] );
    if (isset($data['content'])) $this->content = $data['content'];
    // if (isset($data['personnel'])) $this->personnel  = $data["personnel"];
    // if (isset($data['contractAmount'])) $this->contractAmount  = $data["contractAmount"];
    // if (isset($data['completionDate'])) $this->completionDate  = $data["completionDate"];
  }

  public function storeFormValues ($params) {
    // Stroe all the parameters
    $this ->__construct($params);
  }

  // public static function storeImage($data=array()) {
  //   $imagePath = $data['imagePath'];
  // }

  public static function getById($id) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM portfolio WHERE id = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $id, PDO::PARAM_INT);
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ($row) return new Article ($row);
  }

  public static function getList($numRows=5, $order="id DESC") {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM portfolio ORDER BY $order LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $article = new Article( $row );
      $list[] = $article;
    }

    // Now get the total number of articles that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query($sql)->fetch();
    $conn = null;
    return (array("results"=>$list,"totalRows"=>$totalRows[0]));
  }

  public function insert() {

  // Does the Article object already have an ID?
  if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );

  // Insert the Article
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  $sql = "INSERT INTO portfolio ( title, services, content, imagePath, personnel, contractAmount, completionDate ) VALUES ( :title, :services, :content, :imagePath, :personnel, :contractAmount, :completionDate )";
  $st = $conn->prepare ( $sql );
  $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
  $st->bindValue( ":services", $this->services, PDO::PARAM_STR );
  $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
  $st->bindValue( ":imagePath", $this->imagePath, PDO::PARAM_STR );
  $st->bindValue( ":personnel", $this->personnel, PDO::PARAM_STR );
  $st->bindValue( ":contractAmount", $this->contractAmount, PDO::PARAM_STR );
  $st->bindValue( ":completionDate", $this->completionDate, PDO::PARAM_STR );
  $st->execute();
  $this->id = $conn->lastInsertId();
  $conn = null;
  }

  public function update() {

    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

    // Update the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE portfolio SET title=:title, services=:services, content=:content, personnel=:personnel, contractAmount=:contractAmount, completionDate=:completionDate WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":services", $this->services, PDO::PARAM_STR );
    $st->bindValue( ":personnel", $this->personnel, PDO::PARAM_STR );
    $st->bindValue( ":contractAmount", $this->contractAmount, PDO::PARAM_STR );
    $st->bindValue( ":completionDate", $this->completionDate, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public function delete() {

    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );

    // Delete the image
    unlink($this->imagePath);

    // Delete the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM portfolio WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}





?>
