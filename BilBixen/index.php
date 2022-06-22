<?php

include_once "bilbixenDatabase.php";
session_start();
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

    <title>Bilbixen</title>
</head>
<body>
    
<?php 
include_once "navbar.php";
?>
<?php

$sqlPersonbil = "SELECT * FROM biler WHERE type=1 ORDER BY RAND() LIMIT 1";
$sqlVrag =  "SELECT * FROM biler WHERE type=3 ORDER BY RAND() LIMIT 1";
$sqlVarebil = "SELECT * FROM biler WHERE type=2 ORDER BY RAND() LIMIT 1";


$resultPersonbil = mysqli_query($conn, $sqlPersonbil);
$personbilInfo = mysqli_fetch_array($resultPersonbil);
$personbilId = $personbilInfo['id'];


$resultVrag = mysqli_query($conn, $sqlVrag);
$vragInfo = mysqli_fetch_array($resultVrag);
$vragId = $vragInfo['id'];


$resultVarebil = mysqli_query($conn, $sqlVarebil);
$varebilInfo = mysqli_fetch_array($resultVarebil);
$varebilId = $varebilInfo['id'];


// personbil
$sqlAntalKommentarPersonbil = "SELECT COUNT(*) AS antal FROM kommentar WHERE bilid = $personbilId AND status=1";
$resultAKPersonbil= mysqli_query($conn, $sqlAntalKommentarPersonbil);
$aKPersonbil = mysqli_fetch_array($resultAKPersonbil);

$sqlAntalKommentarPersonbilAdmin = "SELECT COUNT(*) AS antal FROM kommentar WHERE bilid = $personbilId AND status=2";
$resultAKPersonbilAdmin= mysqli_query($conn, $sqlAntalKommentarPersonbilAdmin);
$aKPersonbilAdmin = mysqli_fetch_array($resultAKPersonbilAdmin);

// vrag
$sqlAntalKommentarVrag = "SELECT COUNT(*) AS antal FROM kommentar WHERE bilid = $vragId AND status=1";
$resultAKVrag= mysqli_query($conn, $sqlAntalKommentarVrag);
$aKVrag = mysqli_fetch_array($resultAKVrag);

$sqlAntalKommentarVragAdmin = "SELECT COUNT(*) AS antal FROM kommentar WHERE bilid = $vragId AND status=2";
$resultAKVragAdmin= mysqli_query($conn, $sqlAntalKommentarVragAdmin);
$aKVragAdmin = mysqli_fetch_array($resultAKVragAdmin);


// varebil
$sqlAntalKommentarVarebil = "SELECT COUNT(*) AS antal FROM kommentar WHERE bilid = $varebilId AND status=1";
$resultAKVarebil = mysqli_query($conn, $sqlAntalKommentarVarebil);
$aKVarebil = mysqli_fetch_array($resultAKVarebil);

$sqlAntalKommentarVarebilAdmin = "SELECT COUNT(*) AS antal FROM kommentar WHERE bilid = $varebilId AND status=2";
$resultAKVarebilAdmin= mysqli_query($conn, $sqlAntalKommentarVarebilAdmin);
$aKVarebilAdmin = mysqli_fetch_array($resultAKVarebilAdmin);


?>
<section class="cars__section">
    <h1 class='car__main-heading'>Udvalgte biler</h1>
    <div class="cars__content">
        <h2 class="cars__heading"></h2>
        <div class="heading__block">
            <div class='heading__bil'>
                <h3 class='heading__block-title pb1'>Personbil</h3>
            </div>
            <div class='heading__bil'>
                <h3 class='heading__block-title vr1'>Vrag</h3>
            </div>
            <div class='heading__bil'>
                <h3 class='heading__block-title vb1'>Varebil</h3>
            </div>
        </div>
        <div class="cars__block">
            <form class="cars__pesonbil common__car" method ='POST' action="bilInfo.php">
                <div class="front-card" >
                    <input class='logIn__input name' name='bilId' value="<?php echo $personbilInfo['id'] ?>" >
                    <img src="<?php echo $personbilInfo['billede'] ?>" class="car__front-billede" alt="...">
                    <div class='car__front-kommentar'>
                      
                      <?php
                       if(!isset($_SESSION['loggedIn'])){
                         echo $aKPersonbil['antal'];
                      }
                      else {
                        if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                          echo $aKPersonbil['antal'];
                          if( $aKPersonbilAdmin['antal'] >0){
                            echo "(".$aKPersonbilAdmin['antal'].")";
                          }
                        }
                        else {
                          // til hjemmebruger
                        }
                      }
                       ?>
                    </div>
                    <p class='car__front-price'>
                      <?php
                        if(!isset($_SESSION['loggedIn'])){
                          echo number_format($personbilInfo['pris'],0,"",".");
                        }
                        else {
                          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                            echo number_format(($personbilInfo['pris'] * 0.8),0,"",".");
                          }
                          else {
                            // til hjemmebruger
                          }
                        }
                      ?>
                      DKK
                    </p>
                    <div class="card-body">
                    <h5 class="card__front-title">
                        <?php
                         if(strlen($personbilInfo['model']) <= 27){
                            echo $personbilInfo['model'];
                         }
                         else
                         {
                             echo substr_replace($personbilInfo['model'],"...",24);
                         }
                        ?>
                    </h5>
                    <div class =''>
                    <!-- <p class='card-text'>"."Årgang: ".substr_replace($row['først registreret'],"", 4)."</p> -->
                    <p class='car__front-year '>Årgang: <?php echo substr_replace($personbilInfo['først registreret'],"",4) ?></p>
                    </div>
                    <div class =''>
                    <?php
                    if ($personbilInfo['kørt kilometer'] > 0){
                      echo "<p class='car__front-km'>"."KM - ".number_format($personbilInfo['kørt kilometer'],0,"",".")."</p>";
                    }
                    else {
                      echo  "<p class='car__front-km'>"."KM - "."ikke oplyst"."</p>";
                    }
                    echo "</div>";
                    ?>
                      <button type='submit' class="btn btn-primary btn-front-page">Se alle informationer</button>
                    </div>
                  </div>
                  <!-- <h3 class="cars__heading-card">Personbiler</h3> -->
                </form>
            <form class="cars__varbil common__car"  method ='POST' action="bilInfo.php">
                <div class="front-card" >
                    <input class='logIn__input name' name='bilId' value="<?php echo $vragInfo['id'] ?>">
                    <img src="<?php echo $vragInfo['billede'] ?>" class="car__front-billede" alt="...">
                    <div class='car__front-kommentar'>
                      <?php
                        if(!isset($_SESSION['loggedIn'])){
                          echo $aKVrag['antal'];
                        }
                        else {
                          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                            echo $aKVrag['antal'];
                            if( $aKVragAdmin['antal'] >0){
                              echo "(".$aKVragAdmin['antal'].")";
                            }
                          }
                          else {
                            // til hjemmebruger
                          }
                        }
                       ?>
                    </div>
                    <p class='car__front-price'>
                    <?php
                        if(!isset($_SESSION['loggedIn'])){
                          echo number_format($vragInfo['pris'],0,"",".");
                        }
                        else {
                          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                            echo number_format(($vragInfo['pris'] * 0.8),0,"",".");
                          }
                          else {
                            // til hjemmebruger
                          }
                        }
                      ?> 
                      DKK
                    </p>
                    <div class="card-body">
                    <h5 class="card__front-title">
                        <?php
                         if(strlen($vragInfo['model']) <= 27){
                            echo $vragInfo['model'];
                         }
                         else
                         {
                             echo substr_replace($vragInfo['model'],"...",24);
                         }
                         ?>
                    </h5>
                    <div class =''>
                    <p class='car__front-year '>Årgang: <?php echo substr_replace($vragInfo['først registreret'],"",4) ?></p>
                    </div>
                    <div class =''>
                    <?php
                    if ($vragInfo['kørt kilometer'] > 0){
                      echo "<p class='car__front-km'>".number_format($vragInfo['kørt kilometer'],0,"",".")."</p>";
                    }
                    else {
                      echo  "<p class='car__front-km'>"."KM - "."ikke oplyst"."</p>";
                    }
                    echo "</div>";
                    ?>
                      <button type='submit' class="btn btn-primary btn-front-page">Se alle informationer</button>
                    </div>
                </div>
                  <!-- <h3 class="cars__heading-card">Vrag</h3> -->
                </form>
            <form class="cars__varebil common__car" method ='POST' action="bilInfo.php">
            <div class="front-card">
                <input class='logIn__input name' name='bilId' value="<?php echo $varebilInfo['id'] ?>">
                    <img src="<?php echo $varebilInfo['billede'] ?>" class="car__front-billede" alt="...">
                    <div class='car__front-kommentar'>
                      <?php
                        if(!isset($_SESSION['loggedIn'])){
                        echo $aKVarebil['antal'];
                        }
                        else {
                          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                            echo $aKVarebil['antal'];
                            if( $aKVarebilAdmin['antal'] >0){
                              echo "(".$aKVarebilAdmin['antal'].")";
                            }
                          }
                          else {
                            // til hjemmebruger
                          }
                        }
                       ?>
                    </div>
                    <p class='car__front-price'>
                    <?php
                        if(!isset($_SESSION['loggedIn'])){
                            echo number_format($varebilInfo['pris'],0,"",".");
                        }
                        else {
                          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                            echo number_format(($varebilInfo['pris'] * 0.8),0,"",".");
                          }
                          else {
                            // til hjemmebruger
                          }
                        }
                      ?>
                      DKK
                    </p>
                    <div class="card-body">
                    <h5 class="card__front-title"><?php
                     if(strlen($varebilInfo['model']) <= 27){
                        echo $varebilInfo['model'];
                     }
                     else
                     {
                         echo substr_replace($varebilInfo['model'],"...",24);
                     }
                     ?></h5>
                    <div class =''>
                    <p class='car__front-year'>Årgang: <?php echo substr_replace($varebilInfo['først registreret'],"",4) ?></p>
                    </div>
                    <div class =''>
                    <?php
                    if ($varebilInfo['kørt kilometer'] > 0){
                      echo "<p class='car__front-km'>"."KM - ".number_format($varebilInfo['kørt kilometer'],0,"",".")."</p>";
                    }
                    else {
                      echo  "<p class='car__front-km'>"."KM - "."ikke oplyst"."</p>";
                    }
                    echo "</div>";
                    ?>
                    <button type='sumbit' class="btn btn-primary btn-front-page">Se alle informationer</button>
                    </div>
                </div>
                  <!-- <h3 class="cars__heading-card">Lastvogne</h3> -->
                </form>
        </div>
    </div>
</section>
</body>
</html>