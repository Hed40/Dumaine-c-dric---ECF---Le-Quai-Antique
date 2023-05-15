<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512083207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE desserts RENAME INDEX idx_21bd061c54c8c93 TO IDX_21BD061BCF5E72D');
        $this->addSql('ALTER TABLE drinks RENAME INDEX idx_ead79309c54c8c93 TO IDX_EAD79309BCF5E72D');
        $this->addSql('ALTER TABLE set_menu ADD drinks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A2B4B60FB FOREIGN KEY (drinks_id) REFERENCES drinks (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E8C2D81A2B4B60FB ON set_menu (drinks_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE desserts RENAME INDEX idx_21bd061bcf5e72d TO IDX_21BD061C54C8C93');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A2B4B60FB');
        $this->addSql('DROP INDEX IDX_E8C2D81A2B4B60FB ON set_menu');
        $this->addSql('ALTER TABLE set_menu DROP drinks_id');
        $this->addSql('ALTER TABLE drinks RENAME INDEX idx_ead79309bcf5e72d TO IDX_EAD79309C54C8C93');
    }
}
