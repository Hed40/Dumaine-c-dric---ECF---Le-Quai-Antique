# ECF été 2023 - LE QUAI ANTIQUE - PHP SYMFONY

## Compétences du référentiel concernées

**Activité** - Type 1 : Développer la partie front-end d’une application web ou web mobile en intégrant les recommandations de sécurité.
- 1 Maquetter une application
- 2 Réaliser une interface utilisateur web statique et adaptable 
- 3 Développer une interface utilisateur web dynamique 
- 4 Réaliser une interface utilisateur avec une solution de gestion de contenu ou e-commerce.

**Activité** – Type 2 : Développer la partie back-end d’une application web ou web mobile en intégrant les recommandations de sécurité́.
- 5 Créer une base de données.
- 6 Développer les composants d’accès aux données.
- 7 Développer la partie back-end d’une application web ou web mobile.
- 8 Élaborer et mettre en œuvre des composants dans une application de gestion de
contenu ou e-commerce.

**Objectif principal**:

L’objectif principal de cet ECF sera de passer au moins une fois par chaque étape clé de conception d’une application web complète: analyse des besoins, maquettage, intégration, développement et déploiement.

- Un dossier supplémentaire sera à rendre en plus de votre code source. Une documentation devra y être présente où vous définirez votre choix des technologies employées, les diagrammes, wireframes ainsi que la charte graphique potentiellement élaborée par vos soins.

- Vous devez garder à l’esprit que le correcteur doit être en mesure de pouvoir tester facilement toutes les fonctionnalités de vos applications. Il sera donc nécessaire d’écrire un petit manuel décrivant le processus d’installation de vos solutions en local si besoin.
---
## Livrables

- Le lien du (ou des) dépôt(s) Github public, où sera présent le code de vos applications.
- Le lien de la version en ligne de l’application web.
- Le lien vers votre logiciel de gestion de projet pour cet ECF (Trello, Jira, etc…)

Devra aussi se trouver:

- Un fichier readme.md contenant la démarche à suivre pour l’exécution en local
- Ne pas oublier dans ce readme l’explication de la création d’un administrateur 
pour le back-office de l’application web.

- Les fichiers de création et d’alimentation de la base de données de votre application web (migrations, fixtures ou scripts SQL à la main)

- Une documentation technique au format .pdf avec vos réflexions initiales sur le projet 
(technologies choisies, configuration de l’environnement de travail, diagramme de classe ou Méthode MERISE, diagramme de cas d’utilisation, diagramme de séquence…).


- Une charte graphique au format .pdf regroupant:

- La palette de couleurs.
- La palette des polices d’écriture choisies.
- L’export des maquettes attendues.
- wireframe et/ou mockup pour la version mobile ET desktop.

---

## Présentation du contexte

**LE PROJET Restaurant**

Le Chef Arnaud Michant aime passionnément les produits - et producteurs - de la Savoie.
C’est pourquoi il a décidé d’ouvrir son troisième restaurant dans ce département.

Le Quai Antique sera installé à Chambéry et proposera au déjeuner comme au dîner une expérience gastronomique, à travers une cuisine sans artifice.

Plus encore que ses deux autres restaurants, Arnaud Michant le voit comme une promesse 
d’un voyage dans son univers culinaire.

Lors de l’inauguration de son deuxième établissement, le chef Michant a pu constater 
l’impact positif que pouvait avoir un bon site web sur son chiffre d’affaires. C’est pourquoi il a fait appel à l’agence web dont vous faites partie.

Dans le cadre de cette mission qui vous est affectée, vous aurez à créer une application web vitrine pour le Quai Antique avec ce goût de la qualité que recherche Arnaud Michant.

**Fonctionnalitées demandés par notre client et utilisateurs concernés**

**1.Page de connection**

Utilisateurs concernés: Administrateur, Clients

Le compte administrateur sera créé pour un employé du restaurant en particulier: l’hôte 
d’accueil. C’est lui qui gérera les informations sur le site web.

Toutefois, un autre type de compte sera possible: le “client” (voir US7 - Mentionner des 
allergies).

Quel que soit le type d’utilisateur souhaitant se connecter, il pourra le faire grâce au même 
formulaire de connexion. Les identifiants à entrer seront l’adresse e-mail et un mot de passe 
sécurisé.

**2.Créer une galerie d’images**

Utilisateurs concernés: Administrateur

Sur la page d’accueil, le chef Michant aimerait afficher les photographies de ses plats les plus 
appréciés afin de donner l’eau à la bouche de ses potentiels convives.

Toute photo devra pouvoir être ajoutée, modifiée ou supprimée sur la plateforme 
d’administration.

Chaque photo aura aussi un titre. Il sera visible sur la page d’accueil lors du survol de son 
image.

Un bouton d’appel à l’action vers le module de réservation (Voir US6 - Réserver une table) 
devra être positionné juste après la galerie


**3.Publier la carte du restaurant**

**Utilisateurs concernés:** Administrateur

La carte du restaurant devra être présente sur une page dédiée.

Les plats seront listés dans des catégories (ex: Entrées, Desserts, Burgers, etc).
Les informations nécessaires pour chaque plat sont:
- un titre
- une description
- un prix

**4.Présenter les menus**

**Utilisateurs concernés:** Administrateur

En plus des plats incontournables à proposer, le chef Michant voudrait des menus.
Pour chaque menu, on aura:
- un titre
- une à plusieurs formules, ayant chacune un prix et une description.

**5.Définir les horaires d’ouverture**

**Utilisateurs concernés:** Administrateur

Pour un restaurant, cette information est CAPITALE. 
Pour chaque jour de la semaine, les horaires d’ouverture devront donc être affichés dans le 
pied de chaque page du site.
Le chef Michant souhaite aussi que l’administrateur puisse modifier les horaires à sa guise.


**6.Réserver une table**

**Utilisateurs concernés:** Visiteurs, Clients

Dans le menu, un bouton d’appel à l’action sera particulièrement mis en valeur: “réserver”
Au clic de ce dernier, le visiteur est redirigé sur un formulaire à remplir.
Plusieurs champs seront nécessaires:
- le nombre de couverts
- la date 
- l’heure prévue
- la mention des allergies

Le visiteur doit savoir si des places sont disponibles sans rechargement de la page.
On pourra sélectionner un horaire par tranche de 15 minutes entre l’ouverture et la 
fermeture du restaurant.

La dernière heure avant la fermeture, aucun convive n’est accepté. 
Exemple: si le restaurant ouvre de 12h à 15h, alors on aura
12h00 / 12h15 / 12h30 / 12h45 / 13h00 / 13h15 / 13h30 / 13h45 / 14h00

**7.Limitation du nombre de convives**

**Utilisateurs concernés:** Administrateur

Pour éviter toute déconvenue sur place, il faudra refuser les réservations au-delà d’un certain seuil.
Ce seuil de convives maximum pourra être précisé dans le panel d’administration.

**8.Mentionner des allergies**

**Utilisateurs concernés:** Visiteurs, Clients

Lors de la réservation d’une table, le visiteur peut indiquer si une personne qui l’accompagne 
a des allergies.


**9.Création de compte par le client/ visiteur**

**Utilisateurs concernés:** Visiteurs, Clients

Si le visiteur vient régulièrement dans ce restaurant, il peut aussi créer un compte client et donc gagner du temps lors de la complétion du formulaire.

Quand le visiteur créera son compte, on lui proposera d’entrer une adresse email, un mot de 
passe sécurisé, un nombre de convives par défaut ainsi que la mention des allergies.

Dorénavant, si le visiteur se connecte avant de remplir le formulaire de réservation d’une 
table, le nombre de convives et les allergies seront remplis automatiquement avec les réglages du client.

---

## ANALYSE ET CHOIX TECHNIQUE ##

Après avoir pris connaissance et analysé l'ennoncé, j'ai fait le choix d'utiliser le framework **Symfony** avec le **langage PHP** pour créer l'application web du **Quai Antique**.
L'architecture MVC de Symfony favorisera la maintenance et l'évolutivité de mon application. Grâce à ses composants réutilisables, Symfony offre une flexibilité dans le développement. Il intègre des fonctionnalités de sécurité avancées comme le composant **Security** fournit et aussi des fonctionnalités de sécurité avancées, telles que l'authentification et l'autorisation, pour protéger mon application contre les attaques potentielles. 


