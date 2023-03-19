<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303190151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD cutlery_max_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F53F4437C FOREIGN KEY (cutlery_max_id) REFERENCES cutlery_max (id)');
        $this->addSql('CREATE INDEX IDX_EB95123F53F4437C ON restaurant (cutlery_max_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F53F4437C');
        $this->addSql('DROP INDEX IDX_EB95123F53F4437C ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP cutlery_max_id');
    }
}
