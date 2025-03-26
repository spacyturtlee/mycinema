Cette application web permet de rechercher des films en fonction de différents critères tels que le titre, le réalisateur et le genre. Elle inclut également une fonctionnalité de recherche d'utilisateurs (bien que cette partie ne soit pas entièrement implémentée dans le code fourni).

Fonctionnalités

Recherche de films par :
Titre (partiel ou complet)
Réalisateur
Genre (via une liste déroulante)
Affichage des résultats sous forme de tableau
Interface simple et intuitive
Prérequis

Serveur web avec support PHP (Apache, Nginx, etc.)
Base de données MySQL
PHP PDO activé
Installation

Importer la base de données SQL fournie 
Configurer les paramètres de connexion à la base de données dans le fichier bd.php
Placer tous les fichiers dans le répertoire approprié de votre serveur web
Structure de la Base de Données

La base de données contient au moins les tables suivantes :

movie - Contient les informations sur les films (titre, réalisateur, image)
genre - Liste des genres disponibles
movie_genre - Table de jointure entre films et genres
Utilisation

Accédez à l'application via un navigateur web
Remplissez un ou plusieurs champs de recherche :
Titre du film
Réalisateur
Genre (sélection dans la liste déroulante)
Cliquez sur "Rechercher" pour afficher les résultats
Fichiers inclus

index.php - Page principale avec le formulaire de recherche et l'affichage des résultats
bd.php - Fichier de connexion à la base de données (à configurer)
style.css - Feuille de style pour l'interface (mentionnée mais non fournie)
user.php - Page de recherche d'utilisateurs (mentionnée mais non fournie)
Améliorations possibles

Ajout de pagination pour les résultats
Meilleure gestion des erreurs
Interface plus moderne avec des cartes pour afficher les films
Fonctionnalité de recherche avancée
Système de notation ou de commentaires
