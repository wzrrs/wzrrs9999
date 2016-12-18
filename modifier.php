<?php
// page d'accueil avec un element qui permet de modifié l'article en question. [oui]
// lien d'id par un $_GET[oui]
// sécurisé la variable [NO]
// préremplir champ du formulaire [NO]
// modication du nom du boutons [NO]






////////////////////////////////// article avant modification //////////////////////////////////


<?php
session_start();
// ajout des require et include pour le bon fonctionnement de la page 
require_once ('settings/bdd.inc.php');
require_once ('settings/init.inc.php');

if (isset($_POST['ajouter'])) {

    //print_r($_POST);
//print_r($_FILES);
//exit();

    $date_ajout = date("Y-m-d");
    //echo $date_ajout;
    $_POST['date_ajout'] = $date_ajout;

    /*     * *** if(isset($_POST['publie'])){
      $_POST['publie'] = 1 ;
      } else {
      $_POST['publie'] = 0;
      } */

    $_POST['publie'] = isset($_POST['publie']) ? 1 : 0;




    if ($_FILES['image']['error'] == 0) {
        // echo 'image oui ';
    } else {
        // echo 'image non';
    }


    // print_r($_POST);
    //Création PDO 
    //insertion de requete
    $sth = $bdd->prepare("INSERT INTO articles(titre,texte,date,publie) VALUES(:titre ,:texte ,:date ,:publie)");
    $sth->bindvalue(':titre', $_POST['titre'], PDO::PARAM_STR);
    $sth->bindvalue(':texte', $_POST['texte'], PDO::PARAM_STR);
    $sth->bindvalue(':date', $_POST['date_ajout'], PDO::PARAM_STR);
    $sth->bindvalue(':publie', $_POST['publie'], PDO::PARAM_INT);
    $sth->execute();

    $dernier_id = $bdd->LastInsertId();
    echo "Vous avez ajouté l'article n° $dernier_id";

    $_SESSION['ajout_article'] = TRUE;

    header("Location : article.php");



    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$dernier_id.jpg");
    header('location: article.php');
} else {

    include_once('includes/header.inc.php');
    ?>
    <div class = "span8">
        <?php
        if (isset($_SESSION['ajout_article'])) {
            ?>



            <div class="alert alert-success" role="alert">

                <strong>GG!</strong> c'est bon.
            </div>
            <?php
            unset($_SESSION['ajout_article']);
        }
        ?>
        <form action = "article.php" method = "post" enctype = "multipart/form-data" id = "form_article" name = "form_article">
            <div class = "clearfix">
                <label for = "titre">Titre</label>
                <div class = "input"><input type = "text" name = "titre" id = "titre" value = ""> </div>
            </div>

            <div class = "clearfix">
                <label for = "texte">Texte</label>
                <div class = "input"><textarea type = "text" name = "texte" id = "texte" value = ""></textarea> </div>
            </div>

            <div class = "clearfix">
                <label for = "titre">Image</label>
                <div class = "input"><input type = "file" name = "image" id = "image" value = ""> </div>
            </div>

            <div class = "clearfix">
                <label for = "publie">Publié</label>
                <div class = "input"><input type = "checkbox" name = "publie" id = "publie"> </div>
            </div>

            <div class = "form-actions">

                <input type = "submit" name = "ajouter" id = "ajouter" class = "btn btn-large btn-primary" value = "ajouter">
            </div>

        </form>
    </div>

    <?php
    include_once 'includes/menu.inc.php';
    include_once 'includes/footer.inc.php';
}
?>


