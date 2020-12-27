<?php

require './lib/autoload.php';


$smarty = new Template();
Rotas::get_pagina();


//valores para o template
$smarty->assign('NOME', 'ALLAN');

echo Rotas::get_SiteRAIZ() .'<br>';

$smarty->display('index.tpl');
?>