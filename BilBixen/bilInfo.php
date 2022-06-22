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
    <title>BilInfo</title>
</head>
<body>
<?php 
  include_once "navbar.php";
?>
    <section class='bil__container'>
        <h2 class="bilInfo__heading heading">Detaljer</h2>
        <?php
            //$getBilId = $_POST['bilId'];
            $getBilId = 1;
            $dbBilTable = "biler";
            $dbKommentar = "kommentar";
            
            $sqlBil = "SELECT * FROM $dbBilTable WHERE id = $getBilId";
            $sqlkommentar = "SELECT * FROM $dbKommentar WHERE bilID = $getBilId AND status = 1";
            

            $resultBil = mysqli_query($conn, $sqlBil);
            $bilInfo = mysqli_fetch_array($resultBil);

            $resultKommentar =  mysqli_query($conn, $sqlkommentar);

            echo "<div class='detail__content bilText'>";

                echo "<div class='img__content'>";
                    echo "<img src='" .$bilInfo['billede']. "' class='bil__img' alt='...'>";
                echo "</div>";

                echo "<div class='bil__detail-info'>";
                    echo "<h3 class='bil__block detail__header'>".$bilInfo['model']."</h3>";
                    echo "<div class ='bil__block'>";
                    echo "<p class='detail__paragraf'>Først registreret</p>";
                    echo "<p class='detail__paragraf'>".$bilInfo['først registreret']."</p>";
                    echo "</div>";
                    echo "<div class ='bil__block'>";
                    echo "<p class='detail__paragraf'>KM</p>";
                    if ($bilInfo['kørt kilometer'] > 0){
                      echo "<p class='detail__paragraf'>".number_format($bilInfo['kørt kilometer'],0,"",".")."</p>";
                    }
                    else {
                      echo  "<p class='detail__paragraf'>"."ikke oplyst"."</p>";
                    }
                    echo "</div>";
                    if(!isset($_SESSION['loggedIn'])){
                      echo "<div class='bil__block-btn'><p class='btn-pris'> Pris <br>" .number_format($bilInfo['pris'],0,"",".")." DKK </p></div>";
                    }
                    else {
                      if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3 ){
                        echo "<div class='bil__block-btn'><p class='btn-pris'> Pris <br>" .number_format(($bilInfo['pris'] * 0.8),0,"",".")." DKK </p></div>";
                      }
                      else {
                        // til hjemmebruger
                      }
                    }

                echo "</div>";


            echo "</div>";

            
            ?>




        <h3 class="heading">Kommentarer</h3>

        <div class="main__content">
        <div class="kommentar__scroll">

        <?php

          $sqlkommentarAdmin = "SELECT * FROM $dbKommentar WHERE bilID = $getBilId AND status = 2";
          $resultKommentarAdmin =  mysqli_query($conn, $sqlkommentarAdmin);
          $getKommentarAdmin = mysqli_fetch_array($resultKommentarAdmin);
          // UDEN LOG IND
          foreach($resultKommentar as $row){
              echo"<div class='kommentar__info'>";
                  echo "<h4 class='kommentar__name'>".$row['navn']."</h4>";
                  echo "<p class='kommentar__date common'>".$row['dato']."</p>";
                  echo "<p class='kommentar__text common'>".$row['text']."</p>";
                  echo "<hr>";
              echo"</div>";
          }

          // ADMIN OG FORHANDLER
          if(!isset($_SESSION['loggedIn'])){
          }
          else{
          if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3){
            foreach($resultKommentarAdmin as $row){
              echo"<form class='kommentar__info' method='POST' action='bilInfo.php'>";
                  echo "<input class='logIn__input name' name='kommentarId' value=".$row['id']." />";
                  echo "<h4 class='kommentar__name'>*".$row['navn']."</h4>";
                  echo "<p class='kommentar__date common'>".$row['dato']."</p>";
                  echo "<p class='kommentar__text common'>".$row['text']."</p>";
                  echo "<button type='submit' name='btn-godkend'>Godkend</button>";
                  
                  echo "<hr>";
              echo"</form>";
            }

            if(isset($_POST['btn-godkend'])){
              $getKommentarIdFromBtn = $_POST['kommentarId'];
              if($resultKommentarAdmin){
                
              }
              $kommentarIdAdmin = $getKommentarIdFromBtn;
              // echo $kommentarIdAdmin;
              $sqlGodkedKommentar = "UPDATE kommentar SET status = 1 WHERE id = $kommentarIdAdmin";
              $resultGodkendtKommentar = mysqli_query($conn, $sqlGodkedKommentar);

              if($resultGodkendtKommentar){
                echo "<script>blurt('Kommentaren er godkendt.')</script>";
                // echo "<script>alert('Kommentaren er godkendt.')</script>";
              }
            }
          }
        }

        
        ?>

        </div>    

        <div class="kommentar__section">
  <form class="kommentar__form" method='POST' action='bilInfo.php'>
    <input class='logIn__input name' name='bilId' value="<?php echo $getBilId  ?>" >

    <input type="text"  name="username" class="kommentar__input " placeholder="Navn" required/>
    <input type="email"  name="userEmail" class="kommentar__input "  placeholder="E-mail" required />

    <textarea type="text"   name="textKommentar" class="kommentar__text text-common" placeholder="Kommentar" required></textarea>

  <!-- rows="7" cols="63.2" -->
    <button class="btn btn-primary btn-komm" type="submit" name='sendKommentar'>Send din kommentar</button>
  </form>
  
</div>
          </div>
    </section>    

</body>
</html>



<?php
  
  
  if (isset($_POST['sendKommentar'])){  
    $dbKommentar = "kommentar";
    $bruger = $_POST['username'];
    $brugerEmail =  $_POST['userEmail'];
    $brugerKommentar =  $_POST['textKommentar'];
    $date = date("Y-m-d");
    $godkendelse = 2;

    $sqlSaveKommentar = "INSERT INTO  $dbKommentar  (id,navn, dato, email, text, bilID, status) VALUES (NULL, '$bruger', '$date', '$brugerEmail', '$brugerKommentar','$getBilId', '$godkendelse')";

    if(mysqli_query($conn, $sqlSaveKommentar)){

      echo "<script>alert('Din kommentar er gemt og afventer godkendelse.')</script>";
    }
    else{
      echo "<script>alert('Prøv igen senere.')</script>";
    }
  }  
?>
