<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230406174736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cutlery_max (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, threshold INT DEFAULT NULL, INDEX IDX_225817DB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE desserts (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, allergene VARCHAR(255) DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_21BD061C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(5, 2) NOT NULL, INDEX IDX_957D8CB8BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drinks (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, brand VARCHAR(255) NOT NULL, volume VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, alcool_content VARCHAR(255) NOT NULL, price NUMERIC(5, 2) NOT NULL, INDEX IDX_EAD79309C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, lunch_set_menu_id INT DEFAULT NULL, diner_set_menu_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_727508CFEF3F25DE (lunch_set_menu_id), INDEX IDX_727508CF3EB00C5C (diner_set_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, reservation_user_id INT DEFAULT NULL, guests_number INT DEFAULT NULL, allergie LONGTEXT DEFAULT NULL, heure LONGTEXT DEFAULT NULL, date DATE NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, INDEX IDX_42C84955C0FB6810 (reservation_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_schedule (id INT AUTO_INCREMENT NOT NULL, restaurant_id_id INT DEFAULT NULL, week_day VARCHAR(255) NOT NULL, lunch_opening_time TIME NOT NULL, lunch_closure_time TIME NOT NULL, evening_opening_time TIME NOT NULL, evening_closure_time TIME NOT NULL, INDEX IDX_7A9DDF1435592D86 (restaurant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE set_menu (id INT AUTO_INCREMENT NOT NULL, starter_id INT DEFAULT NULL, dish_id INT DEFAULT NULL, dessert_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, price NUMERIC(5, 2) NOT NULL, INDEX IDX_E8C2D81AAD5A66CC (starter_id), INDEX IDX_E8C2D81A148EB0CB (dish_id), INDEX IDX_E8C2D81A745B52FD (dessert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE starter (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, title VARCHAR(36) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_4042238BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, guests_number INT DEFAULT NULL, allergie VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cutlery_max ADD CONSTRAINT FK_225817DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE desserts ADD CONSTRAINT FK_21BD061C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE drinks ADD CONSTRAINT FK_EAD79309C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CFEF3F25DE FOREIGN KEY (lunch_set_menu_id) REFERENCES set_menu (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF3EB00C5C FOREIGN KEY (diner_set_menu_id) REFERENCES set_menu (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C0FB6810 FOREIGN KEY (reservation_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE restaurant_schedule ADD CONSTRAINT FK_7A9DDF1435592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81AAD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A745B52FD FOREIGN KEY (dessert_id) REFERENCES desserts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE starter ADD CONSTRAINT FK_4042238BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cutlery_max DROP FOREIGN KEY FK_225817DB1E7706E');
        $this->addSql('ALTER TABLE desserts DROP FOREIGN KEY FK_21BD061C54C8C93');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8BCF5E72D');
        $this->addSql('ALTER TABLE drinks DROP FOREIGN KEY FK_EAD79309C54C8C93');
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CFEF3F25DE');
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CF3EB00C5C');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C0FB6810');
        $this->addSql('ALTER TABLE restaurant_schedule DROP FOREIGN KEY FK_7A9DDF1435592D86');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81AAD5A66CC');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A148EB0CB');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A745B52FD');
        $this->addSql('ALTER TABLE starter DROP FOREIGN KEY FK_4042238BBCF5E72D');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649B83297E7');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE cutlery_max');
        $this->addSql('DROP TABLE desserts');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE drinks');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_schedule');
        $this->addSql('DROP TABLE set_menu');
        $this->addSql('DROP TABLE starter');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
