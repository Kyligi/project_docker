# Project_docker
Lancer l'appli : 
Crée un fichier .env à la racine (copie le modèle ci-dessous) pour que Docker sache quels mots de passe utiliser.

Extrait de code
MYSQL_DATABASE=app_db
MYSQL_USER=user_admin
MYSQL_PASSWORD=user_pass
MYSQL_ROOT_PASSWORD=root_password

Ouvre ton terminal dans le dossier du projet et tape :

Bash
docker-compose up -d --build
Une fois fini, rendez-vous sur http://localhost:8080. Si tu vois "Connexion réussie", le réseau interne communique.

Architecture :
Services
(Nginx): Serveur web.
(PHP-FPM): Traite la logique et parle à la bdd. Il ne répond qu'à Nginx.
(MySQL): Stocke nos données.

Réseaux & Sécurité
Double réseau pour plus de sécurité :
(Frontend): Pour la discussion entre Nginx et PHP.
(Backend): Un tunnel privé entre PHP et MySQL pour éviter des intrusions.

Volumes & Persistance
(db_data): est notre volume, les données persistent après des redémarrages.

Guide de test :
1. Tester la communication
Pour prouver que PHP et MySQL se parlent, clique sur le bouton "Ajouter une donnée" sur la page web. Si un message apparaît dans la liste, le dialogue fonctionne.

2. Tester la persistance
Ajoute quelques messages sur le site.
Coupe tout avec : docker-compose down.
Relance avec : docker-compose up -d.
Rafraîchis la page.

Organisation des fichiers
docker-compose.yml : Dirige tout.
/nginx & /php : Les Dockerfiles et la configuration serveur.
/src : Code source PHP.
/sql : Script qui crée automatiquement la table messages au premier lancement.
