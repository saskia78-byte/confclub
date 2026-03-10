<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260310072120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf ADD confmateriel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conf ADD CONSTRAINT FK_14F389A810ACB3E7 FOREIGN KEY (confmateriel_id) REFERENCES conf (id)');
        $this->addSql('CREATE INDEX IDX_14F389A810ACB3E7 ON conf (confmateriel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf DROP FOREIGN KEY FK_14F389A810ACB3E7');
        $this->addSql('DROP INDEX IDX_14F389A810ACB3E7 ON conf');
        $this->addSql('ALTER TABLE conf DROP confmateriel_id');
    }
}
