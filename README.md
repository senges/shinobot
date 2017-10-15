# Shinobot V1.0

## Overview

Petit bot développé en PHP qui peut jouer à votre place à [shinobi.fr](shinobi.fr)  
Projet à but purement éducatif.

Ancien joueur et passionné d'informatique, je me suis lancé dans la réalisation
de ce bot par pur fun. Il n'est en aucun cas destiné à nuire de quelque façon que ce
soit à la communauté ou aux administrateurs du jeu.

Dans la mesure ou l'échange de ressources est impossible entre les joueurs, et que
la revente de compte reste très anecdotique depuis quelques années, j'estime pouvoir
publier ce morceau de code sans mettre en péril la jouabilité ou l'expérience de jeu
des autres utilisateurs. La réalisation de ce bot n'a jamais été (et ne sera jamais)
motivée par des ambitions commerciales.

Pour toute question, proposition, participation ou réclamation : rendez-vous dans la section "contact" en bas de ce document.

Lov. <3

## Fonctionnalités

* Fouiller dans les ruines
* Fouilles à la bibliothèque de Minato
* Lire à la bibliothèque de minato
* Passer l'examen
* Chasser
* Combattre

## Les plus

* Ressusciter en cas de mort
* Level-Up si nécessaire
* Système de logs/debug
* Random User Agent (Minimise risques de détection)
* C'est gratuit

## Pour la suite ?

* Stocker correctement les mots de passe
* Gestion plus pércise des combats
* Automatisation de l'action a effectuer en fonction du lieu, et gestion des erreurs (boucle infinie pour l'instant, hu..)
* Augmenter stats Tai/Nin/Gen
* Amélioration de détection des pages  

## Utilisation

* Depuis un ordinateur

Vous pouvez lancer le script depuis un ordinateur classique.  
Il suffit d'installer un environnement de développement type W/LAMP et d'executer le code en local
  
* Depuis un serveur (ou RaspBerry)

Plus intéressant, vous pouvez héberger le bot sur un serveur d'hébergement.  
Il vous suffit ensuite simplement de programmer un Cron Job tous les X-Heures.  
  
Programmer une tâche cron se fait trais aisément depuis le CPannel.  
Une simple commande suffit :  
  
```bash
php /path/shinobot/function.php
```

Et voilà ! Votre bot est fonctionnel.

## Sources

* Random User Agent

Random user agent creator   
Initial release By Luka Pušić (pusic93@gmail.com) -> Not Working With Shinobot  
Refactored by Mike White (m@mwhite.info)  
  
Link : https://github.com/mwhite/random-uagent

* HTML DOM Handler

simple_html_dom V1.5
Released by S.C. Chen, John Schlick, Rus Carroll

Link : http://sourceforge.net/projects/simplehtmldom/

## Contact

Si vous avez la moindre remarque, réclamation ou que vous souhaitez contribuer au projet,
vous pouvez me contacter des façons suivantes :

- charles.senges@protonmail.com
- C'est tout.
