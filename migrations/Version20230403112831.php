<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403112831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drinks DROP FOREIGN KEY drinks_ibfk_1');
        $this->addSql('DROP INDEX type ON drinks');
        $this->addSql('ALTER TABLE drinks DROP price, DROP image_url, CHANGE brand brand VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE type type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drinks ADD CONSTRAINT FK_EAD79309C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_EAD79309C54C8C93 ON drinks (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drinks DROP FOREIGN KEY FK_EAD79309C54C8C93');
        $this->addSql('DROP INDEX IDX_EAD79309C54C8C93 ON drinks');
        $this->addSql('ALTER TABLE drinks ADD price NUMERIC(7, 2) NOT NULL, ADD image_url VARCHAR(512) DEFAULT NULL, CHANGE brand brand VARCHAR(255) DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE type_id type INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drinks ADD CONSTRAINT drinks_ibfk_1 FOREIGN KEY (type) REFERENCES categories (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX type ON drinks (type)');
    }
}
