<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./css/index.css" rel="stylesheet" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./js/book.js"></script>
  <title>DSMCHS Add Book</title>
</head>
<body>
  <div class="main">
    <h1>DSMCHS Add Book</h1>
    
    <?php
      class UserDB extends SQLite3
      {
        function __construct()
          {
            $this->open('database.db');
          }
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if ($_POST['bookname'] && $_POST['authorname']) {
            $name = $_POST['bookname'];
            $author = $_POST['authorname'];
            $disable = $_POST['disable'] ?? false;
            if ($disable === "true") {
              // migrate database to allow null
              $db = new UserDB();

              $statement = $db -> prepare("INSERT INTO books (title, author, checkedout, checkoutid, checkoutname, checkoutdate) VALUES (:name, :author, false, NULL, NULL, NULL)");
              $statement -> bindValue(':name', $name);
              $statement -> bindValue(':author', $author);

              $statement -> execute();
              echo "<p>Book added successfully!</p>";
            } else {
              if ($_POST['checkoutname'] && $_POST['checkoutid']) {
                $checkoutname = $_POST['checkoutname'];
                $checkoutid = (int) $_POST['checkoutid'];
                $checkoutdate = $_POST['checkoutdate'] ?? date('Y-m-d H:i:s');;
              // echo $checkoutdate;
                $db = new UserDB();
              
                $statement = $db -> prepare("INSERT INTO books (title, author, checkedout, checkoutid, checkoutname, checkoutdate) VALUES (:name, :author, true, :checkoutname, :checkoutid, :checkoutdate)");
                $statement -> bindValue(':name', $name);
                $statement -> bindValue(':author', $author);
                $statement -> bindValue(':checkoutname', $checkoutname);
                $statement -> bindValue(':checkoutid', $checkoutid);
                $statement -> bindValue(':checkoutdate', $checkoutdate);

                $statement -> execute();
                echo "<p>Book added successfully!</p>";
              } else {
                echo "<p>You inputted empty data!</p>";
              }
            }
          } else {
            echo "<p>You inputted empty data!</p>";
          }
          //echo $disable;
      }
    ?>

    <button onclick="window.location.href='./index.php';"><img src="./images/Back_Arrow.svg" width="20" height="20"></button>
    <form action="add.php" method="post">
      <input type="text" name="bookname" id='bookname' placeholder="Book name" required aria-required><br>
      <input type="text" name="authorname" id='authorname' placeholder="Author name" required aria-required><br>
      <label for="checkoutname">Checkout Name</label>
      <input type="text" name="checkoutname" id='checkoutname' placeholder="Checkouted by who" required><br>
      <label for="checkoutid">Checkout's ID</label>
      <input type="number" id="checkoutid" placeholder="ID" name="checkoutid" min="200000" max="999999" required><br>
      <label for="checkoutdate">Checkout date (select none if today)</label>
      <input type="date" name="checkoutdate" id='checkoutdate' placeholder="Checkout date" required><br>
      <input type="checkbox" id="disable" name="disable" value="true">
      <label for="disable">Nobody has checked this out</label><br>
      <button id='submit' class="button">Add Book</button>
    </form>
  <div>
</body>
</html>