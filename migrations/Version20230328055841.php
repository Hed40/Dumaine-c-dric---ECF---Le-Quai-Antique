<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328055841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_schedule ADD restaurant_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_schedule ADD CONSTRAINT FK_7A9DDF1435592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_7A9DDF1435592D86 ON restaurant_schedule (restaurant_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_schedule DROP FOREIGN KEY FK_7A9DDF1435592D86');
        $this->addSql('DROP INDEX IDX_7A9DDF1435592D86 ON restaurant_schedule');
        $this->addSql('ALTER TABLE restaurant_schedule DROP restaurant_id_id');
    }
}
