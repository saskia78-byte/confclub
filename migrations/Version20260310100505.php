<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260310100505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE materielconf (id INT AUTO_INCREMENT NOT NULL, dateresa DATETIME NOT NULL, materiel_id INT DEFAULT NULL, conf_id INT DEFAULT NULL, INDEX IDX_7433CEB216880AAF (materiel_id), INDEX IDX_7433CEB27FDF4958 (conf_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE materielconf ADD CONSTRAINT FK_7433CEB216880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE materielconf ADD CONSTRAINT FK_7433CEB27FDF4958 FOREIGN KEY (conf_id) REFERENCES conf (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materielconf DROP FOREIGN KEY FK_7433CEB216880AAF');
        $this->addSql('ALTER TABLE materielconf DROP FOREIGN KEY FK_7433CEB27FDF4958');
        $this->addSql('DROP TABLE materielconf');
    }
}
