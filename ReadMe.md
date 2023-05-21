# Documentation technique Installation du projet « Le Quai Antique » sous Symfony

Ce guide fournit les étapes nécessaires pour installer et configurer le projet **« Le Quai Antique – Symfony »** localement à partir de GitHub, ainsi que pour installer toutes les dépendances requises.

## **Prérequis**

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

1. **VISUAL STUDIO CODE**

2. **WAMP, XAMPP, MAMP**

3. **[PHP] (version 8.1.1 min) [PHP: Downloads](https://www.php.net/downloads.php)** (fourni avec XAMPP)

4. **[Composer] <https://getcomposer.org/download/>**

5. **[Git] ou GitHub Desktop**

Assurez-vous également d'avoir un environnement de développement **(par exemple, WAMP, XAMPP, MAMP)** installé et configuré correctement sur votre machine.

## **Étapes d'installation**

* Ouvrez un terminal (ou une ligne de commande) sur votre machine et assurez vous d’avoir un compte GitHub. (Identifiants vous seront demandés)

* Accéder au répertoire souhaiter pour stocker le projet :

```cd c:/Users/votreNomUtilisateur```

* Une fois dans le répertoire souhaité, vous pouvez clonez le projet depuis GitHub en exécutant la commande suivante :
`git clone https://github.com/Hed40/Dumaine-c-dric---ECF---Le-Quai-Antique.git `

* Accédez au répertoire du projet :

` cd Dumaine-c-dric---ECF---Le-Quai-Antique`

* Maintenant, ouvrez VS CODE et importez le projet en cliquant sur « Open folder »

* Activer **l’extention=intl** et **l’extension=zip** dans php.ini depuis le répertoire de **Xampp** en enlevant le **« ; »** au début de la ligne.

* Installez toutes les dépendances du projet à l'aide de Composer :

` composer install  `

* Configurez le fichier d'environnement `.env`

* Dupliquer le ficher ` .env ` et le renommer en` .env.local `

Décommenter :

``APP\_ENV=dev``

``APP\_SECRET=0bf69a06bcb68bcd53e71cded639aba5``


Et

``DATABASE\_URL="mysql://root:Root@127.0.0.1:3306/restaurant?&charset=utf8mb4"``

* Assurez-vous de configurer les variables d'environnement appropriées dans le fichier **`.env`** telles que la configuration de la base de données.

* Le mot de passe « Root » renseigné si dessus doit être modifié si vous rencontrez des difficultés d’accès à la base de données, il se peut que vous deviez le modifier dans le fichier **phpMyAdmin config.inc.php**, ou directement le supprimé dans le **DATABASE\_URL**.

``DATABASE\_URL="mysql://root:@127.0.0.1:3306/restaurant?&charset=utf8mb4"``

* Créez la base de données en utilisant les commandes suivantes :

Dans la console, renseigner les lignes suivante :

Création de la base de données

`  php bin/console doctrine:database:create restaurant `

* Migration de la base en attente disponible depuis le dossier de migration :

`  php bin/console doctrine:migrations:migrate `

*  Démarrez le serveur de développement Symfony :

`  Php bin/ server:start `

**!IMPORTANT : Si vous rencontrez des soucis avec le Symfony/server-bundle, (c’est mon cas, au moment où j’écris ces lignes), lancez directement un server local avec PHP :**

`php -S localhost:8000 -t public`	

* L’application Symfony devrait maintenant être accessible à l'adresse [**http://localhost:8000**](http://localhost:8000).

* Connexion à l’interface d’administration**

Afin de vous connecter en tant qu’administrateur, il faudra renseigner les informations de connexion suivantes dans la section membres/ connexion de l’application :

```Email : lequaiantique@restaurant.com```

```Mot de passe : Utc2x5k3340 !```


Vous aurez ainsi un accès à l’interface d’administration de l’application.

### **Recommandation pour l’alimentation en données de l’application via l’interface d’administration.** 

Concernant, l’alimentation en donnée de la partie **« GESTION ET ALIMENTATION DE LA CARTE DU RESTAURANT »** Il est fortement recommandé de renseigner la partie **« Catégorie de Produits »** avant toutes choses.

## Bravo ! vous avez réussi l'installation du  projet !

