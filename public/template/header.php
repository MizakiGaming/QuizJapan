<?php
  include_once('../src/DAO/UserDAO.php');
  include_once('../src/DAO/CardPackageDAO.php');
  if(isset($_SESSION['user'])){
    $compte = unserialize($_SESSION['user']);
  }
  ?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="titre nav-link text-white" href="http://quizjapan/vue/">The Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
              
    <div class="collapse navbar-collapse pl-3" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="http://quizjapan/vue/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://quizjapan/vue/bibliotheque">Bibliothèque</a>
        </li>
        <?php
          if(isset($compte)){
            echo ('<li class="nav-item">');
            echo ('<a class="nav-link" href="http://quizjapan/vue/mesCreations">Mes créations</a>');
            echo ('</li>');   
          }
        ?>
      </ul>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <form method="post" action="http://quizjapan/vue/bibliotheque" class="form-inline my-2 my-lg-0">
            <input id="navbar_search_button" name="navbar_search_button" class="form-control mr-sm-2" type="search" placeholder="Par thème/nom" aria-label="Search" size="35">
            <button name="navbar_submit_button" class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
          </form>
        </li>
      </ul>
<!--  /////////////////////////////////////////////Connexion/deconnexion/////////////////////////////////////////////////// -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php
          if(isset($compte)){
            echo('<span class="nav-link">Nombre de point : ');
            echo $compte->getPoints();
            echo('</span>');
            
          }
          ?>
        </li>
        <li class="nav-item">
        <?php
        if(isset($compte)){
          echo('<a class="nav-link" href="../vue/menuUtilisateur.php">');
          echo $compte->getEmail();
          echo('</a>');
          
        } else {
          echo('<a class="nav-link" data-toggle="modal" data-target="#exampleModal">Connexion</a>');
        }
        ?>
        </li>
        <?php
        if(isset($compte)){
          echo('<li class="nav-item">');
          echo('<a class="nav-link" id="deconnexion" name="deconnexion" href="../controllers/deconnexion.php"><span class="fa fa-power-off fa-2x"></span></a>');
          echo('</li>');
        }
        ?>
      </ul>   
      
      <!-- connexion -->
      <?php
      if(isset($compte)){
      } else {
         include_once('../public/template/AffichageConnexion.php');
      }
      ?>
    </div>
  </nav>

</header>