<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403141230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE set_menu (id INT AUTO_INCREMENT NOT NULL, starter_id INT DEFAULT NULL, dish_id INT DEFAULT NULL, dessert_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, price NUMERIC(5, 2) NOT NULL, INDEX IDX_E8C2D81AAD5A66CC (starter_id), INDEX IDX_E8C2D81A148EB0CB (dish_id), INDEX IDX_E8C2D81A745B52FD (dessert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81AAD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id)');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A745B52FD FOREIGN KEY (dessert_id) REFERENCES desserts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81AAD5A66CC');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A148EB0CB');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A745B52FD');
        $this->addSql('DROP TABLE set_menu');
    }
}
