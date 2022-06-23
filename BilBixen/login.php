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
    

    <title>Document</title>
</head>
<body>
<?php 
  include_once "navbar.php";

?>



<?php
if(isset($_SESSION['loggedIn'])){
  echo "Du er logget ind";
}
else{
?>
    <form class="log__form" action="login.php" method="POST">
        <h3 class="log__heading">Log ind i Bilbixen</h3>
        <input class="log__input" type="text" name="brugernavn" placeholder="Brugernavn" required>
        <input class="log__input" type="password" name="password" placeholder="Password" required>
        <button class="btn btn-primary log__btn" name='log-btn' type="submit">Log ind</button>
    </form>
    </body>
<?php
  if(isset($_POST['log-btn'])){

    // ADMIN
    $sqlTabelAdmin = "administration";
    $adminBrugernavn = $_POST['brugernavn'];
    $adminPassword = $_POST['password'];
    $sqlLoginAdmin = "SELECT * FROM $sqlTabelAdmin WHERE brugernavn = '$adminBrugernavn' AND password = '$adminPassword'";
    $resultAdmin = mysqli_query($conn, $sqlLoginAdmin);


    // FORHANDLER
    $sqlTabelForhandler = "forhandler";
    $forhandlerBrugernavn = $_POST['brugernavn'];
    $forhandlerPaswword = $_POST['password'];
    $sqlLoginForhandler = "SELECT * FROM $sqlTabelForhandler WHERE brugernavn = '$forhandlerBrugernavn' AND password = '$forhandlerPaswword'";
    $resultForhandler = mysqli_query($conn, $sqlLoginForhandler);


    if(mysqli_num_rows($resultAdmin) == 1){
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['rettigheder'] = '3';
      header('location: index.php');
    }

    else if (mysqli_num_rows($resultForhandler) == 1){
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['rettigheder'] = '2';
      header('location: index.php');
    }
    else
    {
      echo "<script>alert('Forkert')</script>";
      header('Refresh: 1; location: login.php');
    }
  }
}


?>
</html>