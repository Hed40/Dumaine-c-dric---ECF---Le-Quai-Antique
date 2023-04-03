<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403170805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, lunch_set_menu_id INT DEFAULT NULL, diner_set_menu_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_727508CFEF3F25DE (lunch_set_menu_id), INDEX IDX_727508CF3EB00C5C (diner_set_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CFEF3F25DE FOREIGN KEY (lunch_set_menu_id) REFERENCES set_menu (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF3EB00C5C FOREIGN KEY (diner_set_menu_id) REFERENCES set_menu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CFEF3F25DE');
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CF3EB00C5C');
        $this->addSql('DROP TABLE menus');
    }
}
