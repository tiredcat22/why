<?php
  class UserDB extends SQLite3
  {
    function __construct()
      {
        $this->open('database.db');
      }
  }
  // turns array to multiple
  // useful for search
  function multiArray($db) {
    $resultArray = $db->fetchArray(SQLITE3_ASSOC);
    // inits a new array
    $multiArray = array();
  
    while($resultArray !== false){
        // pushes result array to multi
        array_push($multiArray, $resultArray); 
        // fetches the next array
        $resultArray = $db->fetchArray(SQLITE3_ASSOC);
    }
    // unset, idk why this in it 
    unset($resultArray); 
    return $multiArray;
  }
  
  $db = new UserDB();
  // allows partial search
  $statement = $db -> prepare("SELECT * FROM books WHERE title LIKE '%' || :query || '%';");
  // prevents sql injection :)
  $statement -> bindValue(':query', htmlspecialchars($_POST['search']));
  $your_result = $statement -> execute();
  // make it to multiple arrays since sqlite does weird things
  $array = multiArray($your_result);
  // echo how many results are found
  echo "<p class='montserrat-500'>" . count($array) . " results found" . "</p>";
  echo '<button id="test"><img src="images/Back_Arrow.svg" width="20" height="20"></button>';
  // print all the info

  /* 
    wip: 
      - add checkout
      - style it
  */
  echo "<div class='container'>";
  for ($x = 0; $x < count($array); $x++) {
    // echo var_dump($array[$x]);
    $checkoutName = ($array[$x]["checkoutID"] == NULL) ? "Checked out by: Nobody" : "Checked out by: " . $array[$x]["checkoutName"];
    $checkoutID = ($array[$x]["checkoutName"] == NULL) ? "Person's ID: No ID" : "Person's ID: " . $array[$x]["checkoutID"];
    $checkoutDate = ($array[$x]["checkoutDate"] == NULL) ? "Checked out at: No date" : "Checked out at: " . $array[$x]["checkoutDate"];
    
    echo "<div class='book'>" . "<h1 class='book-text'>" . htmlspecialchars($array[$x]["title"]) . "</h1>" . "<h2 class='book-author'>" . htmlspecialchars($array[$x]["author"]) . "</h2>" . "<p>" . htmlspecialchars($checkoutName) . "</p>" . "<p>" . htmlspecialchars($checkoutID) . "</p>" . "<p>" . htmlspecialchars($checkoutDate) . "</p>" . "<button book-id='" . $array[$x]["id"] . "' id='update-book' class='button'>Update Book</button>" . "</div>";
    // echo "<div>" . htmlspecialchars("Book: " . $array[$x]["title"] . ", " . "Author: " . $array[$x]["author"] . ", " . "Checked out by " . $checkoutName . ", Checkout ID: " . $checkoutID . ", Checkout date: " . $checkoutDate ) . "<button book-id='" . $array[$x]["id"] ."' id='update-book'>Update Book</button>" . "</div>";
  }
  echo "</div>";

?>