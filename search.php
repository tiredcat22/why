<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/index.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css">
  <script src="./js/search.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>
</head>
<body>
  <div class="main">
    <img alt="dsmchs logo" src="./images/dsmchs.png" class="logo">
    <h1 class="main-text montserrat-500">DSMCHS Library</h1>
    
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       echo "<p class='montserrat-500'>Searching for " .htmlspecialchars($_POST['search']) . "</p>";
       include './templates/results.php';
      } else {
        echo "<p>Woopsie! You didn't submit anything!</p>";
      }
    ?>
  <div>
</body>
</html>