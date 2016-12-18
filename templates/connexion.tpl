


  

    {if isset($connexion) }
        
    <div class="alert alert-error" role="alert">
        <!-- affiche un message de validation d'ajout ou modification -->
        <strong>Erreur!</strong>.
    </div>
        {/if}
 
    
<div class = "span8">

    <form action = "connexion.php" method = "post" enctype = "multipart/form-data" id = "form_article" name = "form_article">

        <!-- formulaire d'ajout / modification avec des valeur dans value définit dans les variables situé plus haut-->
        <div class = "clearfix">
            <!-- Permet d'ajouté un champ qui permet de récuperé l'id de l'article lors de la modification mais aussi 
            de permettre la modication grace a la recupération en $_POST[]-->

        </div>
        <div class = "clearfix">
            <label for = "email">Email</label>
            <div class = "input"><input type = "text" name = "email" id = "email" value ="" > </div>
        </div>

        <div class = "clearfix">
            <label for = "mdp">mdp</label>
            <div class = "input"><input type = "text" name = "mdp" id = "mdp" value=""> </div>
        </div>

        <input type = "submit" name = "connexion" id = "ajouter" class = "btn btn-large btn-primary" value = "connexion">
  


    </form>
    <a href="../index.php">acceder au site sans connexion</a>
</div>