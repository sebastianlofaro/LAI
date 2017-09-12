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




}
?>
