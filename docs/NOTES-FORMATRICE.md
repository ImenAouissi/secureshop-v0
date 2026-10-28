# Notes formatrice : failles volontaires de la v0 (nature uniquement)

Les scénarios d'exploitation se font en séance, dans le laboratoire isolé.

| Où | Nature de la faille | Séquence |
|----|---------------------|----------|
| Toute l'application | Trafic en HTTP clair, pas de pare-feu | 2 |
| search.php, product.php, login.php, register.php | Requêtes SQL construites par concaténation | 3 et 4 |
| login.php, register.php, db/init.sql | Mots de passe stockés en clair | 4 |
| inc/lib.php, docker-compose.yml | Compte de base `root`, secrets dans le code | 4 et 8 |
| search.php, en-tête (compte), product.php (avis) | Sorties non échappées (XSS) | 3 et 6 |
| login.php, product.php | Aucune protection CSRF, pas de limite de tentatives | 5 et 6 |
| Sessions | Cookies sans options Secure, HttpOnly, SameSite | 5 |
| Pages d'erreur | Messages d'erreur PHP et SQL détaillés | 3 |
| docker-compose.yml | Image sans durcissement, exécution en root | 8 |
| admin/users.php | Contrôle d'accès cassé : tout utilisateur connecté peut ouvrir la page, mots de passe en clair affichés | 5 et 7 |
| admin/products.php | Suppression par simple lien (GET) sans protection CSRF, SQL concaténé | 3, 4 et 6 |
| Menu Administration | Masqué côté interface seulement, l'accès réel dépend de chaque page | 7 |
