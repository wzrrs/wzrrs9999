<?php

require_once( 'libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');

$name = "gaetan";


$smarty->assign('name', $name);

//** un-comment the following line to show the debug console
//$smarty->debugging = true;

$smarty->display('smartytest.tpl');
?>