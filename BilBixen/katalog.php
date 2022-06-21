<?php

include_once "bilbixenDatabase.php";
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Logo</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Hjem
                  <span class="visually-hidden">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="katalog.php">Katalog</a>
              </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" href="login.php">Log ind</a>  
                </li>
            </ul>
          </div>
        </div>
      </nav>
<?php

?>
    


<?php
session_start();

$dbBilerTabel = "biler";
$dbKomTabel = "kommentar";

echo "<section class='cars-content container11 content'>";

echo "<h3>Personbiler</h3>";

$sqlPersonbiler  = "SELECT * FROM $dbBilerTabel WHERE type = 1";

if ($resultPersonbiler = mysqli_query($conn, $sqlPersonbiler)) {
  echo "<div class='card-context scrollmenu'>";
  foreach($resultPersonbiler as $row) {
    $bilId = $row['id'];
    $sqlAntalKommentar = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=1";
    $resultAntalKommentar = mysqli_query($conn, $sqlAntalKommentar);
    if($rowAntalKommentarer = mysqli_fetch_array($resultAntalKommentar)){
        echo "<form class='card card-block' style='width: 18rem;' method='POST' action='bilInfo.php'>";

        echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";

        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";
        echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
        echo "<p class='car__price-info'>".number_format($row['pris'],0,"",".")." DKK</p>";
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
    if($rowAntalKommentarer = mysqli_fetch_array($resultAntalKommentar)){
      echo "<form class='card card-block' style='width: 18rem;'  method='POST' action='bilInfo.php'>";
      echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";
        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";
        echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
        echo "<p class='car__price-info'>".number_format($row['pris'],0,"",".")." DKK</p>";
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
    }
    echo "</div>";
}
else {
    echo "<script>alert('VIRKER ikke')</script>";
}

echo "</section>";





//LastVogne

echo "<section class='cars-content container11 content'>";

echo "<h3>Varebiller</h3>";

$sqlVarebiler  = "SELECT * FROM $dbBilerTabel WHERE type = 2";
if ($resultVarebiler = mysqli_query($conn, $sqlVarebiler)) {
  echo "<div class='card-context scrollmenu' >";
  foreach($resultVarebiler as $row) {
    $bilId = $row['id'];
    $sqlAntalKommentar = "SELECT COUNT(*) AS antal FROM $dbKomTabel WHERE bilid = $bilId AND status=1";
    $resultAntalKommentar = mysqli_query($conn, $sqlAntalKommentar);
    if($rowAntalKommentarer = mysqli_fetch_array($resultAntalKommentar)){
      echo "<form class='card card-block' style='width: 18rem;'  method='POST' action='bilInfo.php'>";
      echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";
        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";
        echo "<div class='kom'>".$rowAntalKommentarer['antal']."</div>";
        echo "<p class='car__price-info' name='hidden_price'>".number_format($row['pris'],0,"",".")." DKK</p>";
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