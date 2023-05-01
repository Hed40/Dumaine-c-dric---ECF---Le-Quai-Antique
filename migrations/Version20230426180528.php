<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426180528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cutlery_max (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, threshold INT DEFAULT NULL, INDEX IDX_225817DB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cutlery_max ADD CONSTRAINT FK_225817DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE desserts DROP FOREIGN KEY FK_21BD061C54C8C93');
        $this->addSql('DROP INDEX IDX_21BD061C54C8C93 ON desserts');
        $this->addSql('ALTER TABLE desserts CHANGE categorie_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE desserts ADD CONSTRAINT FK_21BD061C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_21BD061C54C8C93 ON desserts (type_id)');
        $this->addSql('ALTER TABLE drinks DROP FOREIGN KEY FK_EAD79309C54C8C93');
        $this->addSql('DROP INDEX IDX_EAD79309C54C8C93 ON drinks');
        $this->addSql('ALTER TABLE drinks CHANGE categorie_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drinks ADD CONSTRAINT FK_EAD79309C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_EAD79309C54C8C93 ON drinks (type_id)');
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE allergie allergie VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cutlery_max DROP FOREIGN KEY FK_225817DB1E7706E');
        $this->addSql('DROP TABLE cutlery_max');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE desserts DROP FOREIGN KEY FK_21BD061C54C8C93');
        $this->addSql('DROP INDEX IDX_21BD061C54C8C93 ON desserts');
        $this->addSql('ALTER TABLE desserts CHANGE type_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE desserts ADD CONSTRAINT FK_21BD061C54C8C93 FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_21BD061C54C8C93 ON desserts (categorie_id)');
        $this->addSql('ALTER TABLE drinks DROP FOREIGN KEY FK_EAD79309C54C8C93');
        $this->addSql('DROP INDEX IDX_EAD79309C54C8C93 ON drinks');
        $this->addSql('ALTER TABLE drinks CHANGE type_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drinks ADD CONSTRAINT FK_EAD79309C54C8C93 FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_EAD79309C54C8C93 ON drinks (categorie_id)');
        $this->addSql('ALTER TABLE `user` CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(180) DEFAULT NULL, CHANGE allergie allergie VARCHAR(255) DEFAULT NULL');
    }
}
