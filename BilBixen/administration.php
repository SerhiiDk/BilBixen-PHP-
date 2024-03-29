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
  if($_SESSION['rettigheder'] == 3)
  {

    $dbForhandlerTabel = "forhandler";
    $sqlAlleForhandlere  = "SELECT * FROM $dbForhandlerTabel";
    $resultAlleForhandlere = mysqli_query($conn, $sqlAlleForhandlere);

    echo "<h1 style='text-align:center;'>Forhandlere</h1>";

    echo "<div class='forhandler-card  scrollmenuOversigt containerOversigt '>";
    if ($resultAlleForhandlere) {
        foreach($resultAlleForhandlere as $row) {
            echo"<form class='administration__forhandlere' method='POST' action='administration.php'>";

            echo "<h5>".$row['navn']."</h5>";
            echo "<p>Email:<br> ".$row['email']."</p>";
            echo "<p>Brugernavn:<br>".$row['brugernavn']."</p>";


            echo "<input class='logIn__input name' name='forhandlerIdSlet' value=".$row['id']." />";
            echo "<button type='submit' class='btnOversigt__slet oversigt-btn' name='btn-slet'>Slet</button>";

            echo "<br><br>";


            if(isset($_POST['btn-slet'])){
                $getForhandlerIdFromBtn = $_POST['forhandlerIdSlet'];

                $sqlSletForhandler = "DELETE FROM `forhandler` WHERE id = $getForhandlerIdFromBtn";
                $resultSletForhandler = mysqli_query($conn, $sqlSletForhandler);

                if($resultSletForhandler){
                  echo "<script>blurt('Forhandler er slettet.')</script>";

                }
                
            }
            echo "</form>";
 
            
        }
    }
    echo "</div>";
    echo "<hr>";
    ?>
    <div style="display:flex;">
    <form class="administration__form" method='POST' action='administration.php'>
    <h4 style="text-align:center;" >Opret ny forhandler </h4>
    <input type="text"  name="navn" class="forhandler__input admin_input" placeholder="Navn" required/>
    <input type="email"  name="forhandlerEmail" class="forhandler__input admin_input"  placeholder="E-mail" required />
    <input type="text"  name="brugernavn" class="forhandler__input admin_input" placeholder="brugernavn" required/>

    <!-- rows="7" cols="63.2" -->
    <button class="btn btn-primary btn-komm" type="submit" name='opretForhandler'>Opret</button>
    </form>
    </div>
    </body>
    </html>

    <?php
    if (isset($_POST['opretForhandler'])){  
        $dbForhandlerTabel = "forhandler";
        $navn = $_POST['navn'];
        $forhandlerEmail =  $_POST['forhandlerEmail'];
        $ForhandlerBrugernavn =  $_POST['brugernavn'];
        $ForhandlerPassword = strrev($ForhandlerBrugernavn);

        $sqlOpretForhandler = "INSERT INTO $dbForhandlerTabel (`id`, `navn`, `email`, `brugernavn`, `password`, `rettighedder`) VALUES (NULL, '$navn', '$forhandlerEmail', '$ForhandlerBrugernavn', '$ForhandlerPassword', '2')";

        if(mysqli_query($conn, $sqlOpretForhandler)){

        echo "<script>alert('Forhandleren er oprettet.')</script>";
        }
        else{
        echo "<script>alert('Prøv igen senere.')</script>";
        }
    }  
  }
  else
  {
    echo "Du  har ikke rettighederne til at se denne side";
  }
}
else
{
  echo "Du skal logge ind for at kunne se administration side";
}
?>
