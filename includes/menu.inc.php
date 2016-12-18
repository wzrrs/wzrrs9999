<nav class="span4">
    <h3>Menu</h3>
    <form action="seach.php" method="get" enctype="multipart/form-data" id="form_recherche" >

        <div class="clearfix">
            <div class="input"><input type="text" name="recherche" id="recherche" placeholder="Votre recherche..."></div>
        </div>

        <div class="form-inline">
            <input type="submit" name="" value="rechercer" class="btn btn-mini btn-primary">
        </div>

    </form>
    <ul>

        <li><a href="../index.php">Accueil</a></li>
        <?php
        if ($connect == true) {
            ?>
            <li><a href="../article.php">Rédiger un article</a></li>
            <li><a href="../connexion.php?deco=1">Déconnexion</a></li>
            <?php
        } else {
            ?>
            <li><a href="../connexion.php">connexion</a></li>
            <?php
        }
        ?>
    </ul>

</nav>
</div>