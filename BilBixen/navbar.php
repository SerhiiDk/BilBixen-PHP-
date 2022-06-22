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
                  <?php
                    if(!isset($_SESSION['loggedIn'])){
                      echo "<form>";
                      echo "<a class='nav-link active' href='login.php'>Log ind</a>"; 
                      echo "</form>";
                    }
                    else{
                      echo "<form action='.' method='POST'>";
                      echo "<button class='nav-link active' type='submit' name='log_hjem' href='.'>Log ud</button>"; 
                      echo "</form>";
                      if(isset($_POST['log_hjem'])){
                        session_destroy();
                        header('location: .');
                      }
                    }                  
                  ?>
                </li>
            </ul>
          </div>
        </div>
</nav>