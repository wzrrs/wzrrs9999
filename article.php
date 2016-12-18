<?php
session_start();
// ajout des require et include pour le bon fonctionnement de la page 
require_once ('settings/bdd.inc.php'); // connexion a la BDD
require_once ('settings/init.inc.php');
require_once( 'libs/Smarty.class.php'); // smarty class
include_once('includes/connexion.inc.php'); // verrification de la connexion
$idmodif = isset($_GET['id']) ? $_GET['id'] : 'ajouter'; // recuperation de l'id en GET

$idvalidationmodif = $idmodif; //variable idmodif dans idvalidationmodif

if ($idmodif != 'ajouter') { // si id modif diffrent d'ajouté faire une modification en récuperant les donnés dans la table avec l'id obtenue
    $sth = $bdd->prepare("SELECT * FROM articles where id=$idmodif");
    $sth->execute();
    $modif = $sth->fetchAll(PDO::FETCH_ASSOC);

    // print_r($modif);
    //echo $modif[0]['titre'];

    $smarty->assign('modif', $modif);
// variable pour affiché le texte lors de la modification
    $titremodif = $modif[0]['titre'];
    $textemodif = $modif[0]['texte'];
    $publie = $modif[0]['publie'];
//echo $textemodif;
    $bouton = "modifié";
} else {
    // varible pour l'ajout les champs sont vide par défault
    $titremodif = "";
    $textemodif = "";
    $publie = 0;
    $bouton = "ajouté";
    $idvalidationmodif = "";
}

// permet de coche décoché la case dans le formulaire
if ($publie == 1) {
    $publie = "checked";
} else {
    $publie = "";
}


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
    //Insertion de l'ajout ou la modification le choix se fait automatiquement si on récupere une valeur dans le champ ID
    //cepandant l'utilisateur ne peux accédé au champ ID définit en HIDDEN dans le formulaire
    if ($_POST['id'] == "") {

        // requete d'ajout d'un article dans la base de donné
        $sth = $bdd->prepare("INSERT INTO articles(titre,texte,date,publie) VALUES(:titre ,:texte ,:date ,:publie)");
        $sth->bindvalue(':titre', $_POST['titre'], PDO::PARAM_STR);
        $sth->bindvalue(':texte', $_POST['texte'], PDO::PARAM_STR);
        $sth->bindvalue(':date', $_POST['date_ajout'], PDO::PARAM_STR);
        $sth->bindvalue(':publie', $_POST['publie'], PDO::PARAM_INT);
        $sth->execute();

        $dernier_id = $bdd->LastInsertId();
        echo "Vous avez ajouté l'article n° $dernier_id";
        move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$dernier_id.jpg");
        $_SESSION['ajout_article'] = TRUE;
    } else {
        //requete de modification
        $sth = $bdd->prepare("UPDATE articles SET titre=:titre , texte=:texte , publie=:publie WHERE id=:id");
        $sth->bindvalue(':id', $_POST['id'], PDO::PARAM_INT);
        $sth->bindvalue(':titre', $_POST['titre'], PDO::PARAM_STR);
        $sth->bindvalue(':texte', $_POST['texte'], PDO::PARAM_STR);
        $sth->bindvalue(':publie', $_POST['publie'], PDO::PARAM_INT);
        $sth->execute();

        echo "Vous avez modifié l'article ";
        $idimage = $_POST['id'];
        move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$idimage.jpg");
        $_SESSION['ajout_article'] = TRUE;
    }
    // permet de se déplacé instantanément à la page demandé
    header("Location : article.php");



    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$dernier_id.jpg");
    header('location: article.php');
} else {
    // inclue le header
    include_once('includes/header.inc.php');
    $smarty = new Smarty();

    $smarty->setTemplateDir('templates/');
    $smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');
    ?>
    <div class = "span8">
        <?php
        if (isset($_SESSION['ajout_article'])) {
            ?>



            <div class="alert alert-success" role="alert">
                <!-- affiche un message de validation d'ajout ou modification -->
                <strong>GG!</strong> c'est bon.
            </div>
            <?php
            unset($_SESSION['ajout_article']);
        }
        ?>


        <form action = "article.php" method = "post" enctype = "multipart/form-data" id = "form_article" name = "form_article">

            <!-- formulaire d'ajout / modification avec des valeur dans value définit dans les variables situé plus haut-->
            <div class = "clearfix">
                <!-- Permet d'ajouté un champ qui permet de récuperé l'id de l'article lors de la modification mais aussi 
                de permettre la modication grace a la recupération en $_POST[]-->
                <div class = "input"><input type = "hidden" name = "id" id = "id" value = "<?PHP echo $idvalidationmodif ?>"> </div>
            </div>
            <div class = "clearfix">
                <label for = "titre">Titre</label>
                <div class = "input"><input type = "text" name = "titre" id = "titre" value = "<?PHP echo $titremodif ?>"> </div>
            </div>

            <div class = "clearfix">
                <label for = "texte">Texte</label>
                <div class = "input"><textarea type = "text" name = "texte" id = "texte" > <?PHP echo $textemodif ?> </textarea> </div>
            </div>

            <div class = "clearfix">
                <label for = "titre">Image</label>
                <div class = "input"><input type = "file" name = "image" id = "image" value = ""> </div>
            </div>
            <?php
            if ($idmodif == 'ajouter') {
                
            } else {
                ?>
                <img src="img/<?PHP echo $_GET['id']; ?>.jpg   " width="100px"/>
                <?php
            }
            ?>
            <div class = "clearfix">
                <label for = "publie">Publié</label>
                <div class = "input"><input type = "checkbox"  <?PHP echo $publie ?> name ="publie" id = "publie"> </div>
            </div>

            <div class = "form-actions">

                <input type = "submit" name = "ajouter" id = "ajouter" class = "btn btn-large btn-primary" value = "<?PHP echo $bouton ?>">
            </div>


        </form>
    </div>

    <?php
    // inclu le menu et le footer 
    $smarty->display('article.tpl');
    include_once 'includes/menu.inc.php';
    include_once 'includes/footer.inc.php';
}
?>
