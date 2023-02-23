<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219230359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY is_host');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY is_cutlery');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY is_a_host');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY is_cutlery_scheduled');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY is_allergic');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY is_users');
        $this->addSql('ALTER TABLE cutlery_scheduler DROP FOREIGN KEY How_many_cutlery');
        $this->addSql('ALTER TABLE dessert DROP FOREIGN KEY it_is_dessert');
        $this->addSql('ALTER TABLE drink DROP FOREIGN KEY is_is_drink');
        $this->addSql('ALTER TABLE fixed_menus DROP FOREIGN KEY is_it_dessert');
        $this->addSql('ALTER TABLE fixed_menus DROP FOREIGN KEY is_it_starter');
        $this->addSql('ALTER TABLE fixed_menus DROP FOREIGN KEY is_it_drink');
        $this->addSql('ALTER TABLE fixed_menus DROP FOREIGN KEY is_it_maincourse');
        $this->addSql('ALTER TABLE maincourse DROP FOREIGN KEY it_is_main_course');
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY is_fixed_menu');
        $this->addSql('ALTER TABLE starter DROP FOREIGN KEY what_categories');
        $this->addSql('DROP TABLE allergy');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE cutlery');
        $this->addSql('DROP TABLE cutlery_scheduler');
        $this->addSql('DROP TABLE dessert');
        $this->addSql('DROP TABLE drink');
        $this->addSql('DROP TABLE fixed_menus');
        $this->addSql('DROP TABLE host');
        $this->addSql('DROP TABLE maincourse');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE starter');
        $this->addSql('DROP INDEX is_host ON user');
        $this->addSql('ALTER TABLE user ADD id INT AUTO_INCREMENT NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD is_verified TINYINT(1) NOT NULL, DROP user_id, DROP host, DROP birth_year, DROP is_Student, CHANGE firstName firstname VARCHAR(255) NOT NULL, CHANGE lastName lastname VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergy (allergy_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, name VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE booking (booking_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, allergy CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, cutlery CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, cutlery_scheduler CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, user CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, host CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, time TIME NOT NULL, INDEX is_users (user), INDEX is_allergic (allergy), INDEX is_a_host (host), INDEX is_cutlery (cutlery), INDEX is_cutlery_scheduled (cutlery_scheduler), PRIMARY KEY(booking_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories (categories_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cutlery (cutlery_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, number_min INT DEFAULT NULL, number_max INT DEFAULT NULL, available_Cutlery INT DEFAULT NULL, PRIMARY KEY(cutlery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cutlery_scheduler (cutlery_scheduler_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, cutlery_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, time TIME NOT NULL, number_of_cutlery INT DEFAULT NULL, INDEX How_many_cutlery (cutlery_id), PRIMARY KEY(cutlery_scheduler_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dessert (dessert_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categories CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX it_is_dessert (categories), PRIMARY KEY(dessert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE drink (drink_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categories CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX is_is_drink (categories), PRIMARY KEY(drink_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fixed_menus (fixed_menus_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, starter CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, maincourse CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dessert CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, drink CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, price NUMERIC(3, 2) NOT NULL, INDEX is_it_dessert (dessert), INDEX is_it_drink (drink), INDEX is_it_starter (starter), INDEX is_it_maincourse (maincourse), PRIMARY KEY(fixed_menus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE host (host_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(250) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(250) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(host_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maincourse (maincourse_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categories CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX it_is_main_course (categories), PRIMARY KEY(maincourse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menus (menus_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, fixed_menus CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX is_fixed_menu (fixed_menus), PRIMARY KEY(menus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE starter (starter_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categories CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX what_categories (categories), PRIMARY KEY(starter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT is_cutlery FOREIGN KEY (cutlery) REFERENCES cutlery (cutlery_id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT is_a_host FOREIGN KEY (host) REFERENCES host (host_id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT is_cutlery_scheduled FOREIGN KEY (cutlery_scheduler) REFERENCES cutlery_scheduler (cutlery_scheduler_id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT is_allergic FOREIGN KEY (allergy) REFERENCES allergy (allergy_id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT is_users FOREIGN KEY (user) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE cutlery_scheduler ADD CONSTRAINT How_many_cutlery FOREIGN KEY (cutlery_id) REFERENCES cutlery (cutlery_id)');
        $this->addSql('ALTER TABLE dessert ADD CONSTRAINT it_is_dessert FOREIGN KEY (categories) REFERENCES categories (categories_id)');
        $this->addSql('ALTER TABLE drink ADD CONSTRAINT is_is_drink FOREIGN KEY (categories) REFERENCES categories (categories_id)');
        $this->addSql('ALTER TABLE fixed_menus ADD CONSTRAINT is_it_dessert FOREIGN KEY (dessert) REFERENCES dessert (dessert_id)');
        $this->addSql('ALTER TABLE fixed_menus ADD CONSTRAINT is_it_starter FOREIGN KEY (starter) REFERENCES starter (starter_id)');
        $this->addSql('ALTER TABLE fixed_menus ADD CONSTRAINT is_it_drink FOREIGN KEY (drink) REFERENCES drink (drink_id)');
        $this->addSql('ALTER TABLE fixed_menus ADD CONSTRAINT is_it_maincourse FOREIGN KEY (maincourse) REFERENCES maincourse (maincourse_id)');
        $this->addSql('ALTER TABLE maincourse ADD CONSTRAINT it_is_main_course FOREIGN KEY (categories) REFERENCES categories (categories_id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT is_fixed_menu FOREIGN KEY (fixed_menus) REFERENCES fixed_menus (fixed_menus_id)');
        $this->addSql('ALTER TABLE starter ADD CONSTRAINT what_categories FOREIGN KEY (categories) REFERENCES categories (categories_id)');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE `user` MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON `user`');
        $this->addSql('DROP INDEX `PRIMARY` ON `user`');
        $this->addSql('ALTER TABLE `user` ADD user_id CHAR(36) NOT NULL, ADD host VARCHAR(50) NOT NULL, ADD birth_year INT DEFAULT NULL, ADD is_Student TINYINT(1) DEFAULT NULL, DROP id, DROP roles, DROP is_verified, CHANGE firstname firstName VARCHAR(50) DEFAULT NULL, CHANGE lastname lastName VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(250) DEFAULT NULL, CHANGE password password VARCHAR(250) DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT is_host FOREIGN KEY (host) REFERENCES host (host_id)');
        $this->addSql('CREATE INDEX is_host ON `user` (host)');
        $this->addSql('ALTER TABLE `user` ADD PRIMARY KEY (user_id)');
    }
}
