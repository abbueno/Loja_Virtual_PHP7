<?php

require './lib/autoload.php';


$smarty = new Template();


//valores para o template
$smarty->assign('NOME', 'ALLAN');
$smarty->assign('GET_TEMA', Rotas::get_SiteTEMA());


$smarty->display('index.tpl');
?>