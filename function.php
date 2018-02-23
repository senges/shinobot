<?php

/*

@AUTHOR: Charles SENGES
@RELEASE: 12/10/2017
@VERSION: 1.0

*/

include('dom.php');
include('uagent.php'); 
include('config.php'); 

run(LOGIN, PASSWORD, optgen());

function optgen() {
    $opt = array();
    // Action à effectuer
    $opt[0] = THEJOB;
    // Lvl Up
    $opt[1] = LVLUP;
    // Relive
    $opt[2] = RELIVE;
    
    return $opt;
}

function run($pseudo, $pass, $options) {
    $postfields = array();
    $postfields["action"] = "submit";
    $postfields["login"] = $pseudo;
    $postfields["pass"] = $pass;

    doLog($pseudo . "</br>");

    $url = 'http://www.shinobi.fr/index.php?page=connexion';
    $fouiller = 'http://www.shinobi.fr/index.php?page=moteur_ext_ruines_fouiller';
    $combat = 'http://www.shinobi.fr/index.php?page=moteur_combat_m';
    $action = 'http://www.shinobi.fr/index.php?page=moteur_revive';

    $useragent = random_uagent();
    $referer = $url;

    //Initialise une session CURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'a0');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'a0'); 
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Connexion au compte
    $result = curl_exec($ch);
    $round = 1;

    // On fouille
    while(getPA($result) > 0 && !stop()) {
        doLog("Encore des PA</br>");
        $action = setAction($result, $options);
        doLog("Action = " . $action . "</br>");

        curl_setopt($ch, CURLOPT_URL, $action);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.shinobi.fr/index.php');
        curl_setopt($ch, CURLOPT_POST, false);

        $result = curl_exec($ch);
        //doLog(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL), true);
        
        if (gotFight($result)) {
            while (inFight($result)) {
                doLog("# En combat !</br>");

                $postfields = array();
                $postfields["action"] = "submit";
                $postfields["round"] = $round;
                $postfields["round_adv1"] = COMBAT;
                $postfields["x"] = 12;
                $postfields["y"] = 12;

                curl_setopt($ch, CURLOPT_URL, $combat);
                curl_setopt($ch, CURLOPT_REFERER, $combat);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                $result = curl_exec($ch);
                //doLog($result);

                $round++;
            }

            doLog("Ok maintenant retour dans les ruines</br>");

            $postfields = array();
            $postfields["action"] = "submit";

            curl_setopt($ch, CURLOPT_URL, 'http://www.shinobi.fr/index.php?page=jeu');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

            $result = curl_exec($ch);

            $round = 1;
        }
    }

    doLog("No more PA</br>");

    curl_close($ch);
}

function setAction($plain, $options) {
    $url = 'http://www.shinobi.fr/index.php?page=connexion';
    $fouiller = 'http://www.shinobi.fr/index.php?page=moteur_ext_ruines_fouiller';
    $combat = 'http://www.shinobi.fr/index.php?page=moteur_combat_m';
    $life = 'http://www.shinobi.fr/index.php?page=moteur_revive';
    $lvlup = 'http://www.shinobi.fr/index.php?page=level_up';
    $exam = 'http://www.shinobi.fr/index.php?page=moteur_examen';
    $fouiller_biblio = 'http://www.shinobi.fr/index.php?page=moteur_minv_biblio_fouiller';
    $lire = 'http://www.shinobi.fr/index.php?page=moteur_minv_biblio_lire';
    $action = '';

    if (dead($plain) and $options[2] == true) {
        doLog("Ok, I'm dead.. sad..</br>");
        $action = $life;
    }

    else if (maxlvl($plain) and $options[1] == true) {
        doLog("Wow ! Levelup bitch !</br>");
        $action = $lvlup;
    }

    else if ($options[0] == 0 and !dead($plain)) {
        doLog("Let's search motherfucker !</br>");
        $action = $fouiller;
    }

    else if ($options[0] == 1 and !dead($plain)) {
        doLog("Lets kill some n00b !</br>");
        $action = $combat;
    }

    else if ($options[0] == 2 and !dead($plain)) {
        doLog("Lets learn cauz I'm a n00b right now !</br>");
        $action = $exam;
    }

    else if ($options[0] == 3 and !dead($plain)) {
        doLog("Lets read !</br>");
        $action = $lire;
    }

    else if ($options[0] == 4 and !dead($plain)) {
        doLog("Ok je fouille dans la biblio</br>");
        $action = $fouiller_biblio;
    }

    else {
        doLog("Fuck.</br>");
        adios();
    }

    return $action;
}

function inFight($plain) {
    $log = "Presence du formulaire : ";
    strpos($plain, 'form1') ? $log .= "true" : $log .= "false";
    $log .= "</br>";
    doLog($log);
    return (strpos($plain, 'form1') != true);
}

function gotFight($plain) {
    return (strpos($plain, 'Attention !') !== false);
}

function gotUp($plain) {
    return (strpos($plain, 'level_up') !== false);
}

function getPA($plain) {
    $html = new simple_html_dom();
    $html->load($plain);

    $collection = $html->find('#blocPa');

    $pa = 0;
    
    foreach($collection as $e) {

        if ($e->children(2) !== NULL) {
            $extract = $e->children(2);

            $innerHTML = $extract->outertext;
            $innerHTML = trim($innerHTML);
            $innerHTML = preg_replace('/\s+/', '', $innerHTML);
            $innerHTML = str_replace("<divstyle='float:right;'>", '', $innerHTML);
            $innerHTML = str_replace("</div>", '', $innerHTML);

            $pa = intval($innerHTML);
        }
    }

    return $pa;
}

function doLog($plain, $separation = false) {
    if (SHOULDLOG) {
        if (DEBUG)
            echo $plain;
        $file = fopen('log.txt', 'a+');
        if ($separation) {
            $separatr;
            for ($separatr = ""; strlen($separatr) < 40; $separatr.='-');
            $separatr = "\n\n".$separatr."\n\n";
            fputs($file, $separatr);
        }
        fputs($file, $plain);
    }
}

function dead($plain) {
    $log = "Mort ? : ";
    strpos($plain, 'moteur_revive') ? $log .= "true" : $log .= "false";
    $log .= "</br>";
    doLog($log);
    return (strpos($plain, 'moteur_revive') == true);
}

function maxlvl($plain) {
    return (strpos($plain, 'level_up') == true);
}

function stop() {
    return false;
}

function adios() {
    exit();
}
