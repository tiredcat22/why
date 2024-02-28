<?php
class UserDB extends SQLite3
{
  function __construct()
    {
      $this->open('../database.db');
    }
}

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['id'] && $_POST['name'] && $_POST['bookid']) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $checkoutdate = date('Y-m-d H:i:s');
      $bookid = $_POST['bookid'];
      // echo $checkoutdate;
      $db = new UserDB();

      $statement = $db -> prepare("UPDATE books SET checkedout = true, checkoutid = :checkoutid, checkoutname = :checkoutname, checkoutdate = :checkoutdate WHERE id = :id");
      $statement -> bindValue(':checkoutname', $name);
      $statement -> bindValue(':checkoutid', $id);
      $statement -> bindValue(':checkoutdate', $checkoutdate);
      $statement -> bindValue(':id', $bookid);

      $statement -> execute();
      
    } else if ($_POST['bookid'] && $_POST['checkout']) {
      // $checkout = $_POST['checkout'];
      $id = $_POST['bookid'];
      $db = new UserDB();
      $statement = $db -> prepare("UPDATE books SET checkedout = false, checkoutid = :checkoutid, checkoutname = :checkoutname, checkoutdate = :checkoutdate WHERE id = :id");
      $statement -> bindValue(':checkoutname', NULL);
      $statement -> bindValue(':checkoutid', NULL);
      $statement -> bindValue(':checkoutdate', NULL);
      $statement -> bindValue(':id', $id);
      
      $statement -> execute();
    }
  }
?>