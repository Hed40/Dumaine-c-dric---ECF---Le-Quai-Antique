<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403124046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE drinks (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, brand VARCHAR(255) NOT NULL, volume NUMERIC(5, 2) NOT NULL, description LONGTEXT DEFAULT NULL, alcohol_content NUMERIC(5, 2) NOT NULL, price NUMERIC(5, 2) NOT NULL, INDEX IDX_EAD79309C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE drinks ADD CONSTRAINT FK_EAD79309C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drinks DROP FOREIGN KEY FK_EAD79309C54C8C93');
        $this->addSql('DROP TABLE drinks');
    }
}
