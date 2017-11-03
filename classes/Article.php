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
  public $subcategory = null;
  public $lastImageID = null;

  public function __construct($data=array()) {
    if (isset($data['id'])) $this->id = (int) $data['id'];
    if (isset($data['imagePath'])) $this->imagePath = $data['imagePath'];
    if (isset($data['title'])) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if (isset($data['services'])) $this->services = $data['services'];
    if (isset($data['content'])) $this->content = $data['content'];
    if (isset($data['personnel'])) $this->personnel  = $data["personnel"];
    if (isset($data['contractAmount'])) $this->contractAmount  = $data["contractAmount"];
    if (isset($data['completionDate'])) $this->completionDate  = $data["completionDate"];
    if (isset($data['subcategory'])) $this->subcategory = (int) $data["subcategory"];
    if (isset($data['lastImageID'])) $this->lastImageID = $data['lastImageID'];
  }

  public function storeFormValues ($params) {
    // Stroe all the parameters
    $this ->__construct($params);
  }

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

  public static function getListOfSubCat($key) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM portfolio WHERE subcategory = $key";

    $st = $conn->prepare( $sql );
    //$st = bindValue( ":key", $key, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $article = new Article( $row );
      $list[] = $article;
    }

    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query($sql)->fetch();
    $conn = null;

    return (array("results"=>$list,"totalRows"=>$totalRows[0]));
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
  $sql = "INSERT INTO portfolio ( title, services, content, imagePath, personnel, contractAmount, completionDate, subcategory, lastImageID ) VALUES ( :title, :services, :content, :imagePath, :personnel, :contractAmount, :completionDate, :subcategory, :lastImageID )";
  $st = $conn->prepare ( $sql );
  $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
  $st->bindValue( ":services", $this->services, PDO::PARAM_STR );
  $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
  $st->bindValue( ":imagePath", $this->imagePath, PDO::PARAM_STR );
  $st->bindValue( ":personnel", $this->personnel, PDO::PARAM_STR );
  $st->bindValue( ":contractAmount", $this->contractAmount, PDO::PARAM_STR );
  $st->bindValue( ":completionDate", $this->completionDate, PDO::PARAM_STR );
  $st->bindValue( ":subcategory", $this->subcategory, PDO::PARAM_INT );
  $st->bindValue( ":lastImageID", $this->lastImageID, PDO::PARAM_INT );
  $st->execute();
  $this->id = $conn->lastInsertId();
  $conn = null;
  }

  // Removes "temp" from file name in file path
  public static function detempifyImagePathsForID( $articleID ) {
    // Get current image path for articleID

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT imagePath FROM portfolio WHERE id = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $articleID, PDO::PARAM_INT);
    $st->execute();
    $oldImagePath = $st->fetch();
    $conn = null;

    // Change image path
    $newImagePath = str_replace('temp', $articleID, $oldImagePath);
    // Update database
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE portfolio SET imagePath=:imagePath WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":imagePath", $newImagePath[0], PDO::PARAM_STR );
    $st->bindValue( ":id", $articleID, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public static function imagePathForID( $articleID ) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT imagePath FROM portfolio WHERE id = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $articleID, PDO::PARAM_INT);
    $st->execute();
    $oldImagePath = $st->fetch();
    $conn = null;
    return $oldImagePath;
  }

  public static function updateImagePathForID( $imagePath, $articleID ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE portfolio SET imagePath=:imagePath WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":imagePath", $imagePath, PDO::PARAM_STR );
    $st->bindValue( ":id", $articleID, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public function update() {

    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

    // Update the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE portfolio SET title=:title, services=:services, content=:content, personnel=:personnel, contractAmount=:contractAmount, completionDate=:completionDate, subcategory=:subcategory, imagePath=:imagePath, lastImageID=:lastImageID WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":services", $this->services, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":personnel", $this->personnel, PDO::PARAM_STR );
    $st->bindValue( ":contractAmount", $this->contractAmount, PDO::PARAM_STR );
    $st->bindValue( ":completionDate", $this->completionDate, PDO::PARAM_STR );
    $st->bindValue( ":subcategory", $this->subcategory, PDO::PARAM_INT );
    $st->bindValue( ":imagePath", $this->imagePath, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":lastImageID", $this->lastImageID, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public function delete() {

    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );

    // Delete the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM portfolio WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}





?>
