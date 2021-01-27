<html lang="fr">
    <?php 
        include_once('../public/template/head.php');
    ?>

    <body>
        <?php
            if(isset($_SESSION['erreur'])){
                $erreur = $_SESSION['erreur'];
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
                        <button onclick=window.location.href='../vue/menuUtilisateur.php' class="btn btn-success">Retour</button>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-center">Création d'une carte :</h3>
                        <form action="../controllers/creationPackage.php" method="POST" enctype="multipart/form-data">
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
                                    <div class="text-center"><span name="addQuesttion" id="addQuestion" class="btn btn-success mt-4">Ajouter une question</span></div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center"><button type="submit" name="modification" id="modification" class="btn btn-success mt-4">Création de la carte</button></div>
                                </div>
                            </div>
                            <?php
                                if (isset($erreur)) { 
                                    echo('<div class="text-center alert alert-danger">');  
                                    echo $erreur ;
                                    echo('</div>');
                                    unset($_SESSION['erreur']);
                                }
                            ?>
                        </form>                    
                    </div>
                </div>           
            </div>
        </main>

        <?php include_once('../public/template/footer.php'); ?>
        
        <script>
            var add = document.getElementById('addQuestion');
            let contenu = "<div class='form-row'>";
            contenu +="<div class='form-group col'>";
            contenu +="<label for='name'>Question</label>";
            contenu +="<input type='text' class='form-control' id='question' name='question' required>";
            contenu +="</div>";
            contenu +="</div>"
            contenu +="<div class='form-row'>"
            contenu +="<div class='form-group col'>";
            contenu +="<label for='name'>Bonne réponse</label>";
            contenu +="<input type='text' class='form-control' id='goodAnswer' name='goodAnswer' required>";
            contenu +="</div>";
            contenu +="</div>";
            contenu +="<div class='form-row'>";
            contenu +="<div class='form-group col'>";
            contenu +="<label for='name'>Mauvaise réponse</label>";
            contenu +="<input type='text' class='form-control' id='badAnswer' name='badAnswer' required>";
            contenu +="</div>";
            contenu +="</div>";
            var compteurQuestionFausse = 1;
            
            add.addEventListener('click', event => {
                event.preventDefault();
                compteurQuestionFausse++;
                $('#questionaire').empty();
                
                contenu +="<div class='form-row'>";
                contenu +="<div class='form-group col'>";
                contenu +="<label for='name'>Mauvaise réponse supplémentaire</label>";
                contenu +="<input type='text' class='form-control badAnswer' name='badAnswer[]' required>";
                contenu +="</div>";
                contenu +="</div>";

                // if(compteurQuestionFausse != 5){
                //     contenu +='<div class="text-center"><span name="addQuesttion" id="addQuestion" class="btn btn-success mt-4">Ajouter une question</span></div>'
                //     contenu +="<div class='text-center'><button type='submit' name='modification' id='modification' class='btn btn-success mt-4'>Création de la carte</button></div>";
                // } else {
                //     contenu +="<div class='text-center'><button type='submit' name='modification' id='modification' class='btn btn-success mt-4'>Création de la carte</button></div>";
                // }
                $('#questionaire').append(contenu);
            });
        </script>
    </body>
</html>