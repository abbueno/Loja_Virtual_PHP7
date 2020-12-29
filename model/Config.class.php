<?php

Class Config {

    // Informações básicas do site
    const SITE_URL = "http://localhost";
    const SITE_PASTA = "Meus_projetos/Loja_Virtual_PHP7";
    const SITE_NOME = "Loja Virtual";
    const SITE_EMAIL_ADM = "allanbighibueno@gmail.com";


    //Informações do Banco de Dados
    const BD_HOST = "localhost";
    const BD_USER = "root";
    const BD_SENHA = "";
    const BD_BANCO = "lojavirtual";
    
    
    // Informações para PHP MAILLER
    const EMAIL_HOST = "smtp.gmail.com";
    const EMAIL_USER = "allanbighibueno@gmail.com";
    const EMAIL_SENHA = "allanbighibueno@gmail.com";
    const EMAIL_PORTA = 587;
    const EMAIL_SMTPAUTH = true;
    const EMAIL_SMTPSECURE = "tls";
    const EMAIL_COPIA = "allanbighibueno@gmail.com";
}
?>