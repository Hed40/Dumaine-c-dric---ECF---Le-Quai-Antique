<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219232338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE starter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(36) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE starter_categories (starter_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_70EB5574AD5A66CC (starter_id), INDEX IDX_70EB5574A21214B7 (categories_id), PRIMARY KEY(starter_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE starter_categories ADD CONSTRAINT FK_70EB5574AD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE starter_categories ADD CONSTRAINT FK_70EB5574A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starter_categories DROP FOREIGN KEY FK_70EB5574AD5A66CC');
        $this->addSql('ALTER TABLE starter_categories DROP FOREIGN KEY FK_70EB5574A21214B7');
        $this->addSql('DROP TABLE starter');
        $this->addSql('DROP TABLE starter_categories');
    }
}
