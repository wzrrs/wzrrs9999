<?php
require_once ('settings/bdd.inc.php');
require_once ('settings/init.inc.php');

include_once('includes/connexion.inc.php');


$recherche = $_GET['recherche'];
// moteur de recherche d'article 
$sth = $bdd->prepare("SELECT id,titre,texte,DATE_FORMAT(date,'%d/%m/%Y')as date_fr FROM articles WHERE (titre LIKE :recherche OR texte LIKE :recherche)");
$sth->bindValue(':recherche', "%$recherche%", PDO::PARAM_STR);
$sth->execute();
$count = $sth->rowCount(); //compte le nbre de ligne dans le résultat de la requête
if ($count >= 1) {
    $tab_recherches = $sth->fetchAll(PDO::FETCH_ASSOC);
    $nbarticle = $sth->fetchAll(PDO::FETCH_BOTH);
    $nombre = 2;
    $p = isset($_GET['p']) ? $_GET['p'] : 1;
    $articletotal = $nbarticle[0]['nbarticle'];
    $index = (-1 + $p) * 2;
    $page = ceil($articletotal / $nombre);
    //print_r($tab_recherches);

    foreach ($tab_recherches as $value) {
        ?>
        <h2> <?PHP echo $value['titre']; ?> </h2>
        <img src="img/<?PHP echo $value['id']; ?>.jpg   " width="100px" alt="<?PHP echo $value['titre']; ?>"/>
        <p style="text-align: justify"> <?PHP echo $value['texte']; ?> </p>
        <p style="text-align: justify"> publie le : <?PHP echo $value['date_fr']; ?> </p>
        <!--Permet d'accedé à la page de modification de l'article --> 
        <a href="article.php?id=<?= $value['id'] ?>">Modifier</a>



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
} else {
    echo "Aucun résultat";
}
//Fin de la discussion
?>