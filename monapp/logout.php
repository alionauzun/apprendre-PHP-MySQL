<?php

session_start(); //démarre la session
require_once(__DIR__ . '/function.php'); //inclut le fichier variables.php

//Détruire la session
session_unset();
session_destroy();

//Rediriger l'utilisateur vers la page d'accueil
redirectToUrl('index.php');
