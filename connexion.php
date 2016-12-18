<?php

session_start();
// ajout des require et include pour le bon fonctionnement de la page 
require_once ('settings/bdd.inc.php');
require_once ('settings/init.inc.php');
require_once( 'libs/Smarty.class.php');



//$sql="SELECT * FROM utilisateur WHERE email= :email AND mdp = :mdp";

$deco = isset($_GET['deco']) ? $_GET['deco'] : '0';
if ($deco == 1) {
    setcookie('sid', time() - 1);
    setcookie('PHPSESSID', time() - 1);
}
if (isset($_POST['connexion'])) {
    $sth = $bdd->prepare("SELECT * FROM utilisateur WHERE email= :email AND mdp = :mdp");
    $sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $sth->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR);
    $email = $_POST['email'];
//print_r($_POST);
    $sth->execute();
    $id = $sth->fetchAll(PDO::FETCH_ASSOC);
//print_r($id);

    $count = $sth->rowCount();


//creation d'un coockie de connexion.
    if ($count > 0) {
        $id2 = $id[0]['id'];
        $sid = md5($email . time());
        setcookie('sid', $sid, time() + 3600);
        $sth = $bdd->prepare('UPDATE utilisateur SET sid=:sid where id=:id2');
        $sth->bindValue(':sid', $sid, PDO::PARAM_STR);
        $sth->bindValue(':id2', $id2, PDO::PARAM_INT);
        $sth->execute();
        $_SESSION['connexion'] = TRUE;
        echo"lol";
        header('Location: index.php');
    } else {
        //erreur de connexion
        $_SESSION['connexion'] = FALSE;
    }
}



$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');
include_once('includes/header.inc.php');

if (isset($_SESSION['connexion'])) {
    $smarty->assign('connexion', $_SESSION['connexion']);
}
?>

<?php

// inclu le menu et le footer 

$smarty->display('connexion.tpl');

include_once 'includes/footer.inc.php';
?>
