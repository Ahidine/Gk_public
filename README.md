-Premièrement faut installer laravel spacie permission et LaravelFullcalendar
-faut lancer les migrations  le seeder suivant :
	 	-Php artisan db: seed-class=RolesTableSeeder
	 	-php artisan db:seed --class=UsersTableSeeder
	 	-php artisan db: seed-class=JoursTableSeeder
	 	-php artisan db: seed-class=SalleTableSeeder 

la page d'acceuil c'est une page de login et par défaut le login et le passowrd déjà saisi en mode placeholder 
si les seeder sont bien effectués il suffit de cliquer sur "se connecter" et vous allez diriger vers la page d'accueil

** guide :
1- faut creer les responsables notamment le responsable(directeur) afin de l'affecter lors de la création
 des centres avec le champ des centres vide ( ça va passer is not requiers) 
2- creer les centres 
3- creer les niveaux
 	affectés chaque niveau aux centres que vous voulez en précisant les prix 
4- ajouter les professeurs 
5- creer les groupes
 	en créant les trimestres dedans 
6- ajouter les emplois du temps pour les groupes 
7- créer des préinscrits soit via postman soit via la plateforme "vous allez trouver comment ajouter un préinscrit" 
8- valider l'inscription des élèves que vous voulez 

*********** 
vous pouvez visualiser les données des élèves les professeurs des responsables et ajouter d'autres comme  l'absence,
 voir l emplois du temps ... 

pour les salaires des responsables faut insérer via la base de données vu que c'est un profil(responsable technique)
 qui va se charger de la saisie des salaires( les salaires se sont les salaires qu'ont eu lieu c a d que les responsables
ont vraiement recu leurs dans la date X la plateforme est prete a vous dire quel est le salaire qu'il faut payer pour le reponsable
X ou le professeur Y selon des crietere dont l'absence fait partie mais fait développer la partie front-end )


!!!   Ps: les composants de vues supposent que la racine d'URL c'est public, je m'explique pour avoir les villes afin
 d'ajouter un centre l'URL c'est "/getvillebelgique" il suppose que
 www.gk.Stage Maroc/getvillebelgique == localhost/gk/public/getvillebelgique
 sinon il y aura des problèmes 