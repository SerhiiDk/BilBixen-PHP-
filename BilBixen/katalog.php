<?php

include_once "bilbixenDatabase.php";
session_start();
unset ($_SESSION['bilID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/style2.css">
    
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>BilBixen</title>
</head>
<body>
<?php 
  include_once "navbar.php";
?>

<?php

$dbBilerTabel = "biler";
$dbKomTabel = "kommentar";

echo "<section class='cars-content container11 content'>";

//Personbiler

echo "<h3>Personbiler</h3>";

$sqlPersonbiler  = "SELECT * FROM $dbBilerTabel WHERE type = 1";

if ($resultPersonbiler = mysqli_query($conn, $sqlPersonbiler)) {
  echo "<div class='card-context scrollmenu'>";
  foreach($resultPersonbiler as $row) {
    $bilId = $row['id'];
    $sqlAntalKommentar = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=1";
    $resultAntalKommentar = mysqli_query($conn, $sqlAntalKommentar);
    $rowAntalKommentarer = mysqli_fetch_array($resultAntalKommentar);

    $sqlAntalKommentarAdmin = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=2";
    $resultAntalKommentarAdmin = mysqli_query($conn, $sqlAntalKommentarAdmin);
    $rowAntalKommentarerAdmin = mysqli_fetch_array($resultAntalKommentarAdmin);

        echo "<form class='card card-block' style='width: 18rem;' method='POST' action='bilInfo.php'>";

        echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";

        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";

        if(!isset($_SESSION['loggedIn'])){
          echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
        }
        else {
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
            if( $rowAntalKommentarerAdmin['antal'] > 0){
              echo "<div class='kom'><span>".$rowAntalKommentarer['antal']."(".$rowAntalKommentarerAdmin['antal'].")"."</span></div>";
              goto a;
            }
            echo "<div class='kom'><span>".$rowAntalKommentarer['antal']."</span></div>";
            a:;
          }
          else {
            // til hjemmebruger
          }
        }

        if(!isset($_SESSION['loggedIn'])){
          echo "<p class='car__price-info'>".number_format($row['pris'],0,"",".")." DKK</p>";
        }
        else {
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
            echo "<p class='car__price-info'>".number_format(($row['pris'] * 0.8),0,"",".")." DKK</p>";
          }
          else {
            // til hjemmebruger
          }
        }

        if(strlen($row['model']) <= 23 ) {
          echo "<h5 class='card-title'>".$row['model']."</h5>";
        }
        else {
          echo "<h5 class='card-title'>".substr_replace($row['model'],"...", 21)."</h5>";
        }

        echo "<p class='card-text'>"."Årgang: ".substr_replace($row['først registreret'],"", 4)."</p>";

        if ($row['kørt kilometer'] > 0){
          echo  "<p class='card-text'>"."KM - ".number_format($row['kørt kilometer'],0,"",".")."</p>";
        }
        else {
          echo  "<p class='card-text'>"."KM - "."ikke oplyst"."</p>";
        }

        //echo  "<p class='card-text'>"."KM - " .$row['kørt kilometer'] == 0? 0: number_format($row['kørt kilometer'],0,"",".")."</p>";
        echo "<button  type='submit' class='btn btn-primary'>Se alle informationer</button>";
        // echo "</div>"; 
        echo "</form>";
    }
    echo "</div>";
}
else {
    echo "<script>alert('VIRKER ikke')</script>";
}

echo "</section>";

echo "<section class='cars-content container11 content'>";




//Vrag Biler

echo "<h3>Vrag</h3>";

$sqlVrag  = "SELECT * FROM $dbBilerTabel WHERE type = 3";
if ($resultVrag = mysqli_query($conn, $sqlVrag)) {
  echo "<div class='card-context scrollmenu'>";
  foreach($resultVrag as $row) {
    $bilId = $row['id'];
    $sqlAntalKommentar = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=1";
    $resultAntalKommentar = mysqli_query($conn, $sqlAntalKommentar);
    $rowAntalKommentarer = mysqli_fetch_array($resultAntalKommentar);

    $sqlAntalKommentarAdmin = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=2";
    $resultAntalKommentarAdmin = mysqli_query($conn, $sqlAntalKommentarAdmin);
    $rowAntalKommentarerAdmin = mysqli_fetch_array($resultAntalKommentarAdmin);

      echo "<form class='card card-block' style='width: 18rem;'  method='POST' action='bilInfo.php'>";
      echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";
        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";

        if(!isset($_SESSION['loggedIn'])){
          echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
        }
        else {
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
            if( $rowAntalKommentarerAdmin['antal'] > 0){
              echo "<div class='kom'>".$rowAntalKommentarer['antal']."(".$rowAntalKommentarerAdmin['antal'].")"."</div>";
              goto b;
            }
            echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
            b:;
          }
          else {
            // til hjemmebruger
          }
        }
        


        if(!isset($_SESSION['loggedIn'])){
          echo "<p class='car__price-info'>".number_format($row['pris'],0,"",".")." DKK</p>";
        }
        else {
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
            echo "<p class='car__price-info'>".number_format(($row['pris'] * 0.8),0,"",".")." DKK</p>";
          }
          else {
            // til hjemmebruger
          }
        }

        if(strlen($row['model']) <= 23 ) {
          echo "<h5 class='card-title'>".$row['model']."</h5>";
        }
        else {
          echo "<h5 class='card-title'>".substr_replace($row['model'],"...", 21)."</h5>";
        }

        echo "<p class='card-text'>"."Årgang: ".substr_replace($row['først registreret'],"", 4)."</p>";

        if ($row['kørt kilometer'] > 0){
          echo  "<p class='card-text'>"."KM - " .number_format($row['kørt kilometer'],0,"",".")."</p>";
        }
        else {
          echo  "<p class='card-text'>"."KM - "."ikke oplyst"."</p>";
        }

        echo "<button type='submit' class='btn btn-primary'>Se alle informationer</button>";
        // echo "</div>"; 
        echo "</form>";
    }
    echo "</div>";
}
else {
    echo "<script>alert('VIRKER ikke')</script>";
}

echo "</section>";





//Varebiler

echo "<section class='cars-content container11 content'>";

echo "<h3>Varebiller</h3>";

$sqlVarebiler  = "SELECT * FROM $dbBilerTabel WHERE type = 2";
if ($resultVarebiler = mysqli_query($conn, $sqlVarebiler)) {
  echo "<div class='card-context scrollmenu' >";
  foreach($resultVarebiler as $row) {
    $bilId = $row['id'];
    $sqlAntalKommentar = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=1";
    $resultAntalKommentar = mysqli_query($conn, $sqlAntalKommentar);
    $rowAntalKommentarer = mysqli_fetch_array($resultAntalKommentar);

    $sqlAntalKommentarAdmin = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=2";
    $resultAntalKommentarAdmin = mysqli_query($conn, $sqlAntalKommentarAdmin);
    $rowAntalKommentarerAdmin = mysqli_fetch_array($resultAntalKommentarAdmin);

      echo "<form class='card card-block' style='width: 18rem;'  method='POST' action='bilInfo.php'>";
      echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";
        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";

        if(!isset($_SESSION['loggedIn'])){
          echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
        }
        else {
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
            if( $rowAntalKommentarerAdmin['antal'] > 0){
              echo "<div class='kom'>".$rowAntalKommentarer['antal']."(".$rowAntalKommentarerAdmin['antal'].")"."</div>";
              goto c;
            }
            echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
            c:;
          }
          else {
            // til hjemmebruger
          }
        }

        if(!isset($_SESSION['loggedIn'])){
          echo "<p class='car__price-info'>".number_format($row['pris'],0,"",".")." DKK</p>";
        }
        else {
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
            echo "<p class='car__price-info'>".number_format(($row['pris'] * 0.8),0,"",".")." DKK</p>";
          }
          else {
            // til hjemmebruger
          }
        }

        if(strlen($row['model']) <= 23 ) {
          echo "<h5 class='card-title'>".$row['model']."</h5>";
        }
        else {
          echo "<h5 class='card-title'>".substr_replace($row['model'],"...", 21)."</h5>";
        }

        echo "<p class='card-text'>"."Årgang: ".substr_replace($row['først registreret'],"", 4)."</p>";

        if ($row['kørt kilometer'] > 0){
          echo  "<p class='card-text'>"."KM - " .number_format($row['kørt kilometer'],0,"",".")."</p>";
        }
        else {
          echo  "<p class='card-text'>"."KM - "."ikke oplyst"."</p>";
        }

        echo "<button class='btn btn-primary vrag__btn' name='btn' type='submit'>Se alle informationer</button>";
        // echo "</div>"; 
        echo "</form>";
    }
    echo "</div>";
}
else {
    echo "<script>alert('VIRKER ikke')</script>";
}

echo "</section>";




?>


</body>

<footer class="footer">
  <div class="footer__content">
    <h3 class="footer__header">BilBixen A/S</h3>
    <address class="footer__addresse">
      Brugtogn City <br><br>
      3784 Brugtvogn City <br><br>
      + 45 637 726 78 <br><br>
      hello@bilbixen.com <br><br>
     </address>
  </div>  
</footer>
<!-- <script src="example.js"></script> -->
</html>