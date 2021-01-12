<?php
  include_once('../src/class/User.php');
  if(isset($_SESSION['user'])){
    $compte = unserialize($_SESSION['user']);
  }
  ?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="titre nav-link text-white" href="http://quizjapan/vue/">QuizJapan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
              
    <div class="collapse navbar-collapse pl-5" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="http://quizjapan/vue/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://quizjapan/vue/vueErreur">Si un lien ne marche pas clique moi</a>
        </li>
      </ul>
<!--  /////////////////////////////////////////////Connexion/deconnexion/////////////////////////////////////////////////// -->
      <ul class="navbar-nav">
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