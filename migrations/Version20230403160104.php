<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403160104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus ADD formule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF2A68F4D1 FOREIGN KEY (formule_id) REFERENCES set_menu (id)');
        $this->addSql('CREATE INDEX IDX_727508CF2A68F4D1 ON menus (formule_id)');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A745B52FD');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81AAD5A66CC');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A148EB0CB');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A745B52FD FOREIGN KEY (dessert_id) REFERENCES desserts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81AAD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CF2A68F4D1');
        $this->addSql('DROP INDEX IDX_727508CF2A68F4D1 ON menus');
        $this->addSql('ALTER TABLE menus DROP formule_id');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81AAD5A66CC');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A148EB0CB');
        $this->addSql('ALTER TABLE set_menu DROP FOREIGN KEY FK_E8C2D81A745B52FD');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81AAD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id)');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE set_menu ADD CONSTRAINT FK_E8C2D81A745B52FD FOREIGN KEY (dessert_id) REFERENCES desserts (id)');
    }
}
