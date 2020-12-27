<?php

require './lib/autoload.php';


$smarty = new Template();


//valores para o template
$smarty->assign('NOME', 'ALLAN');

$smarty->display('index.tpl');
?>