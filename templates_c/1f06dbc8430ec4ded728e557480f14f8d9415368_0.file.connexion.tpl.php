<?php
/* Smarty version 3.1.30, created on 2016-11-28 13:00:31
  from "/home/u760877908/public_html/templates/connexion.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583c2a6fa86090_36010907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f06dbc8430ec4ded728e557480f14f8d9415368' => 
    array (
      0 => '/home/u760877908/public_html/templates/connexion.tpl',
      1 => 1480337133,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_583c2a6fa86090_36010907 (Smarty_Internal_Template $_smarty_tpl) {
?>



  

    <?php if (isset($_smarty_tpl->tpl_vars['connexion']->value)) {?>
        
    <div class="alert alert-error" role="alert">
        <!-- affiche un message de validation d'ajout ou modification -->
        <strong>GG!</strong> T'es con.
    </div>
        <?php }?>
 
    
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
</div><?php }
}
