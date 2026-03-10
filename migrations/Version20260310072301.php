<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260310072301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel ADD confmateriel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B09110ACB3E7 FOREIGN KEY (confmateriel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_18D2B09110ACB3E7 ON materiel (confmateriel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B09110ACB3E7');
        $this->addSql('DROP INDEX IDX_18D2B09110ACB3E7 ON materiel');
        $this->addSql('ALTER TABLE materiel DROP confmateriel_id');
    }
}
