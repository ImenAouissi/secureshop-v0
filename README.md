# SecureShop v0

Mini-boutique en ligne **volontairement vulnérable**, pour le projet fil rouge du module Sécurité informatique et web.

> **Laboratoire uniquement.** Ne jamais exposer cette version sur Internet. Ne jamais réutiliser ce code en production.

## Démarrage

    docker compose up -d --build

Attendre environ 30 secondes (premier démarrage de MySQL), puis ouvrir http://localhost:8080

Repartir de zéro (base comprise) : `docker compose down -v`

## Comptes de test

| Rôle | E-mail | Mot de passe |
|------|--------|--------------|
| Administrateur | admin@secureshop.local | admin123 |
| Client | client@secureshop.local | client123 |

## Structure

    secureshop-v0/
    ├── docker-compose.yml   3 services : web (Nginx), php (PHP-FPM), db (MySQL)
    ├── nginx/default.conf   configuration du serveur web
    ├── php/Dockerfile       image PHP 8.2 avec mysqli
    ├── db/init.sql          schéma et données de test
    ├── app/
    │   ├── index.php        catalogue
    │   ├── search.php       recherche
    │   ├── product.php      fiche produit et avis
    │   ├── login.php  register.php  logout.php
    │   ├── admin/           back-office (tableau de bord, produits, utilisateurs)
    │   ├── inc/             connexion base, en-tête, pied de page
    │   └── assets/style.css design
    └── docs/NOTES-FORMATRICE.md

## Fonctionnalités de ce socle

Catalogue, recherche, fiche produit, avis clients, inscription, connexion, déconnexion.

**Back-office (rôle administrateur) :** tableau de bord, gestion des produits (ajout, modification, suppression), liste des utilisateurs. Le client n'a pas le menu « Administration ».

À ajouter dans les prochaines séquences : panier et commandes, API REST.
