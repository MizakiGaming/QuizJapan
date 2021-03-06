<html lang="fr">
    <?php 
        include_once('../public/template/head.php');
    ?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
            }

            if(isset($_SESSION['granted'])) {
                $granted = $_SESSION['granted'];
            }
            include_once('../public/template/header.php');

            if(!isset($compte)) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $id_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : -1;
            $id_package = is_numeric($id_package) ? $id_package : -1;

            if($id_package === -1) {
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }

            $dao = new CardPackageDAO();

            $package = $dao->getCardPackageById($id_package);

            if($package === false || $package->getCreator()->getId() !== $compte->getId()) {
                $dao->close();
                header("location:http://quizjapan/vue/mesCreations");
                exit(0);
            }
        ?>

        <main>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-4">
                        <button onclick=window.location.href='../vue/mesCreations.php' class="btn btn-success">Retour aux créations</button>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-center">Création d'une carte :</h3>
                        <form action="../controllers/cardCreate.php?package=<?= $id_package ?>" method="POST" enctype="multipart/form-data">
                            <div id="questionaire">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="name">Question</label>
                                        <input type="text" class="form-control" id="question" name="question" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="name">Bonne réponse</label>
                                        <input type="text" class="form-control" id="goodAnswer" name="goodAnswer" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="name">Mauvaise réponse</label>
                                        <input type="text" class="form-control badAnswer" name="badAnswer[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center"><span name="addQuesttion" id="addQuestion" class="btn btn-primary mt-4">Ajouter une question</span></div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-success mt-4">Création de la carte</button></div>
                                </div>
                            </div>
                            <?php
                                if (isset($erreur)) { 
                                    echo('<div class="text-center alert alert-danger mt-2">');  
                                    echo $erreur ;
                                    echo('</div>');
                                    unset($_SESSION['erreur']);
                                }
                                else if (isset($granted)) {
                                    echo('<div class="text-center success alert-success mt-2">');
                                    echo $granted ;
                                    echo('</div>');
                                    unset($_SESSION['granted']);
                                }
                            ?>
                        </form>                    
                    </div>
                </div>           
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>
        
        <script  src="../public/Js/answerCreate.js"></script>
    </body>
</html>