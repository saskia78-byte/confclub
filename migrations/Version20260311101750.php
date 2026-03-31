<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260311101750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf ADD createby_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conf ADD CONSTRAINT FK_14F389A87663CD76 FOREIGN KEY (createby_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_14F389A87663CD76 ON conf (createby_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf DROP FOREIGN KEY FK_14F389A87663CD76');
        $this->addSql('DROP INDEX IDX_14F389A87663CD76 ON conf');
        $this->addSql('ALTER TABLE conf DROP createby_id');
    }
}
