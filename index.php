<?php
session_start();
// ajout des require et include pour le bon fonctionnement de la page 
require_once ('settings/bdd.inc.php');
require_once ('settings/init.inc.php');
include_once('includes/header.inc.php');
include_once('includes/connexion.inc.php');
// pagination



if (isset($_SESSION['connexion'])) {
    ?>



    <div class="alert alert-success" role="alert">
        <!-- affiche un message de validation d'ajout ou modification -->
        <strong>GG!</strong> c'est bon.
    </div>
    <?php
    unset($_SESSION['connexion']);
}

$sth = $bdd->prepare("SELECT COUNT(*) AS nbarticle FROM articles WHERE publie =:publie");
$sth->bindValue(':publie', 1, PDO::PARAM_INT);
$sth->execute();


$nbarticle = $sth->fetchAll(PDO::FETCH_BOTH);
//print_r($nbarticle);

$nombre = 2;
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$articletotal = $nbarticle[0]['nbarticle'];
$index = (-1 + $p) * 2;
$page = ceil($articletotal / $nombre);

// fin pagination

$sth = $bdd->prepare("select id,titre,texte,DATE_FORMAT(date,'%d/%m/%Y')as date_fr from articles where publie = :publie LIMIT $index,$nombre ;"); // preparation de la requete avec la date en français
$sth->bindValue(':publie', 1, PDO::PARAM_INT); // définie le pointeur de :publie afin d'évité les injections sql
$sth->execute(); // execute la requête

$tab_articles = $sth->fetchAll(PDO::FETCH_BOTH); // donne le nom de la clé dans le tableau
//print_r($tab_articles); //debug
?>
<div class="span8">
    <!-- notifications -->

    <!-- contenu -->

    <?PHP
    // permet d'affiché les articles avec leur titre leur image , l'article , la date
    foreach ($tab_articles as $value) {
        ?>
        <h2> <?PHP echo $value['titre']; ?> </h2>
        <img src="img/<?PHP echo $value['id']; ?>.jpg   " width="100px" alt="<?PHP echo $value['titre']; ?>"/>
        <p style="text-align: justify"> <?PHP echo $value['texte']; ?> </p>
        <p style="text-align: justify"> publie le : <?PHP echo $value['date_fr']; ?> </p>
        <!--Permet d'accedé à la page de modification de l'article --> 

        <?php
        if ($connect == true) {
            ?>
            <a href="article.php?id=<?= $value['id'] ?>">Modifier</a>
            <?php
        } else {
            
        }
        ?>



        <?php
    }
    ?>



    <!-- Crée le nombre de page par rapport au nombre d'article en ligne dans la base de donnée --> 
    <div class="pagination">
        <ul>
            <li><a> page : </a>
            </li>


            <?php
            FOR ($i = 1; $i <= $page; $i++) {
                ?>

                <?php
                if ($i == $p) {
                    ?>
                    <li class='active'>
                        <a href='index.php?p=<?= $i ?>'> <?= $i ?>  </a> 
                    </li>
                    <?php
                } else {
                    ?>
                    <li     >
                        <a href='index.php?p=<?= $i ?>'> <?= $i ?>  </a> 
                    </li>
                    <?php
                }

                //class active du li
            }
            ?>
        </ul> 
    </div>
</div>

<?php
//inclu le menu et le footer
include_once 'includes/menu.inc.php';
include_once 'includes/footer.inc.php';
?>
        


