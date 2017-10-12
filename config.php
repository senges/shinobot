<?php

// ############################################## //
// ############## // CONFIG FILE // ############# //
// ############################################## //

/*

@AUTHOR: Charle SENGES
@RELEASE: 12/10/2017
@VERSION: 1.0

*/

// Set true to enable Log File
define("SHOULDLOG", true);
// Set true to display log
define("DEBUG", true);
// User Login
define("LOGIN", "");
// User Password
define("PASSWORD", "");

/*  Actions que le bot doit effectuer :
        0.Fouiller Ruine, 
        1.Chasse, 
        2.Examen, 
        3.Lire, 
        4.Fouiller Bibliotheque */
define("THEJOB", 2);
// Autoriser le bot à level-up
define("LVLUP", true);
// Autoriser le bot à ressusciter
define("RELIVE", true);
// Action a effecteur en cas de combat
define("COMBAT", "atk");

/* -- TODO --

    # Mot de passe en clair dans le fichier -> Pas cool !
    # Ajout fonctionnalités
    # Automatisation de THEJOB
    # Changer le comportement en combat (ne peut qu'attaquer pour l'instant)
    # Augmenter Tai/Nin/Gen

 -- */