<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230319163030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(5, 2) NOT NULL, relation VARCHAR(255) NOT NULL, INDEX IDX_957D8CB8BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F53F4437C');
        $this->addSql('DROP INDEX IDX_EB95123F53F4437C ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP cutlery_max_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8BCF5E72D');
        $this->addSql('DROP TABLE dish');
        $this->addSql('ALTER TABLE restaurant ADD cutlery_max_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F53F4437C FOREIGN KEY (cutlery_max_id) REFERENCES cutlery_max (id)');
        $this->addSql('CREATE INDEX IDX_EB95123F53F4437C ON restaurant (cutlery_max_id)');
    }
}
