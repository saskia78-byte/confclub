<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260309135359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conf_conferencier (conf_id INT NOT NULL, conferencier_id INT NOT NULL, INDEX IDX_82F763847FDF4958 (conf_id), INDEX IDX_82F76384F14895FB (conferencier_id), PRIMARY KEY (conf_id, conferencier_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE conf_conferencier ADD CONSTRAINT FK_82F763847FDF4958 FOREIGN KEY (conf_id) REFERENCES conf (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conf_conferencier ADD CONSTRAINT FK_82F76384F14895FB FOREIGN KEY (conferencier_id) REFERENCES conferencier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf_conferencier DROP FOREIGN KEY FK_82F763847FDF4958');
        $this->addSql('ALTER TABLE conf_conferencier DROP FOREIGN KEY FK_82F76384F14895FB');
        $this->addSql('DROP TABLE conf_conferencier');
    }
}
