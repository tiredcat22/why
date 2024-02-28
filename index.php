<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./css/index.css" rel="stylesheet" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
  <title>DSMCHS Library</title>
</head>
<body>
  <div class="main">
    <img alt="dsmchs logo" src="./images/dsmchs.png" class="logo">
    <h1 class="main-text montserrat-500">DSMCHS Library</h1>
    <div class="search-bar">
      <div class="search-box">
        <form action="search.php" method="post">
        <input type="search" name="search" id='key' placeholder="Search for book">
          </form>
        <button class ='submit' method="post"> <img src="images/search.png" width="20" height="20" class="search"></button>
      </div>
      </div>
    <div class="center">
    
    <button onclick="window.location.href='./add.php';" class="button">
    Add a Book</button>
    </div>
  </div>
 
</body>
</html>