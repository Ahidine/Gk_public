-Premi�rement faut installer laravel spacie permission et LaravelFullcalendar
-faut lancer les migrations  le seeder suivant :
	 	-Php artisan db: seed-class=RolesTableSeeder
	 	-php artisan db:seed --class=UsersTableSeeder
	 	-php artisan db: seed-class=JoursTableSeeder
	 	-php artisan db: seed-class=SalleTableSeeder 

la page d'acceuil c'est une page de login et par d�faut le login et le passowrd d�j� saisi en mode placeholder 
si les seeder sont bien effectu�s il suffit de cliquer sur "se connecter" et vous allez diriger vers la page d'accueil

** guide :
1- faut creer les responsables notamment le responsable(directeur) afin de l'affecter lors de la cr�ation
 des centres avec le champ des centres vide ( �a va passer is not requiers) 
2- creer les centres 
3- creer les niveaux
 	affect�s chaque niveau aux centres que vous voulez en pr�cisant les prix 
4- ajouter les professeurs 
5- creer les groupes
 	en cr�ant les trimestres dedans 
6- ajouter les emplois du temps pour les groupes 
7- cr�er des pr�inscrits soit via postman soit via la plateforme "vous allez trouver comment ajouter un pr�inscrit" 
8- valider l'inscription des �l�ves que vous voulez 

*********** 
vous pouvez visualiser les donn�es des �l�ves les professeurs des responsables et ajouter d'autres comme  l'absence,
 voir l emplois du temps ... 

pour les salaires des responsables faut ins�rer via la base de donn�es vu que c'est un profil(responsable technique)
 qui va se charger de la saisie des salaires( les salaires se sont les salaires qu'ont eu lieu c a d que les responsables
ont vraiement recu leurs dans la date X la plateforme est prete a vous dire quel est le salaire qu'il faut payer pour le reponsable
X ou le professeur Y selon des crietere dont l'absence fait partie mais fait d�velopper la partie front-end )


!!!   Ps: les composants de vues supposent que la racine d'URL c'est public, je m'explique pour avoir les villes afin
 d'ajouter un centre l'URL c'est "/getvillebelgique" il suppose que
 www.gk.Stage Maroc/getvillebelgique == localhost/gk/public/getvillebelgique
 sinon il y aura des probl�mes 