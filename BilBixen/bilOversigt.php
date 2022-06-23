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


if(isset($_SESSION['loggedIn']))
{
  if($_SESSION['rettigheder'] == 2 || $_SESSION['rettigheder'] == 3)
  {

    echo "<h4> Opret ny bil </h4>";

    ?>
    <form class="bilOprettelse__form" method='POST' action='bilOversigt.php'>
    <input type="text"  name="bilModel" class="bilOprettelse__input " placeholder="Model" required/>
    <input type="text"  name="bilPris" class="bilOprettelse__input "  placeholder="Pris" required />
    <input type="text"  name="bilKM" class="bilOprettelse__input "  placeholder="Kørt kilometer" required />
    <!-- Skal ændres til dato værdi -->
    <input type="text"  name="bilRegistrering" class="bilOprettelse__input "  placeholder="først registreret" required />
    <!-- Skal ændres til valgmulighedder 1(personbil) 2(varebil) 3(vrag) -->
    <input type="text"  name="bilType" class="bilOprettelse__input "  placeholder="type" required />
    <!-- Skal ændres til valgmulighedder for alle forhandlere -->
    <input type="text"  name="bilForhandler" class="bilOprettelse__input "  placeholder="forhandler" required />
    <!-- Skal ændres til valgmulighedder 1(tilgængelig) 2(Solgt)) 3(Til udlejning) -->
    <input type="text"  name="bilStatus" class="bilOprettelse__input "  placeholder="Status" required />
    <input type="text"  name="bilBillede" class="bilOprettelse__input "  placeholder="Billede" required />

    <!-- rows="7" cols="63.2" -->
    <button class="btn btn-primary btn-komm" type="submit" name='opretBil'>Opret</button>
    </form>
    </body>
    </html>

    <?php
    if (isset($_POST['opretBil'])){  

        $dbForhandlerTabel = "biler";

        $bilModel = $_POST['bilModel'];
        $bilPris = $_POST['bilPris'];
        $bilKørtKM = $_POST['bilKM'];
        $bilRegistrering = $_POST['bilRegistrering'];
        $bilType = $_POST['bilType'];
        $bilForhandler = $_POST['bilForhandler'];
        $bilStatus = $_POST['bilStatus'];
        $bilBillede = $_POST['bilBillede'];

        $sqlOpretBil = "INSERT INTO `biler`(`id`, `model`, `pris`, `kørt kilometer`, `først registreret`, `type`, `forhandler`, `status`, `billede`) VALUES (NULL,'$bilModel','$bilPris','$bilKørtKM','$bilRegistrering','$bilType','$bilForhandler','$bilStatus','$bilBillede')";

        if(mysqli_query($conn, $sqlOpretBil)){

        echo "<script>alert('Bilen er oprettet.')</script>";
        }
        else{
        echo "<script>alert('Prøv igen senere.')</script>";
        }
    }  
    






    echo "<br><hr>";




























    $dbBilerTabel = "biler";

    $sqlAllebiler  = "SELECT * FROM $dbBilerTabel";
    $resultAllebiler = mysqli_query($conn, $sqlAllebiler);

    if ($resultAllebiler) {
      echo "<div class='card-context scrollmenu'>";
      foreach($resultAllebiler as $row) {
        
        echo "<form class='card card-block' style='width: 18rem;' method='POST' action='bilOversigt.php'>";

        echo "<input class='logIn__input name' name='bilId' value=".$row['id']." >";

        echo "<img src='" .$row['billede']. "' class='img_style' alt='...'>";

        if(strlen($row['model']) <= 23 ) {
          echo "<h5 class='card-title'>".$row['model']."</h5>";
        }
        else {
          echo "<h5 class='card-title'>".substr_replace($row['model'],"...", 21)."</h5>";
        }

        echo "<p class='card-text'>"."ID: ".$row['id']."</p>";

        echo "<button  type='submit' class='btn btn-primary'>Se alle informationer</button>";

        echo "<br>";


        echo "<input class='logIn__input name' name='bildIdSolgt' value=".$row['id']." />";
        echo "<button type='submit' name='btn-solgt'>Solgt</button>";

        echo "<br>";

        echo "<input class='logIn__input name' name='bilIdSlet' value=".$row['id']." />";
        echo "<button type='submit' name='btn-slet'>Slet</button>";
        





        if(isset($_POST['btn-solgt'])){
          $getBilIdFromSolgtBtn = $_POST['bildIdSolgt'];

          $sqlSolgtBil = "UPDATE biler SET status = 2 WHERE id = $getBilIdFromSolgtBtn";

          if(mysqli_query($conn, $sqlSolgtBil)){
            echo "<script>blurt('Bilen er registreret som solgt.')</script>";
          }
        }

        if(isset($_POST['btn-slet'])){
          $getBilIdFromSletBtn = $_POST['bilIdSlet'];

          $sqlSletBil = "DELETE FROM `biler` WHERE id = $getBilIdFromSletBtn";

          if(mysqli_query($conn, $sqlSletBil)){
            echo "<script>blurt('Bilen er slettet.')</script>";
          }
        }




        echo "</form>";





      }
      echo "</div>";
    }
    else {
        echo "<script>alert('VIRKER ikke')</script>";
    }

  }
  else
  {
    echo "Du  har ikke rettighedderne til at se denne side";
  }
}
else
{
  echo "Du skal logge ind for at kunne se denne side";
}





?>