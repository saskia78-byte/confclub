<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260331105307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conf (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_conf DATETIME NOT NULL, date_ajout DATETIME NOT NULL, statut VARCHAR(255) DEFAULT NULL, theme_id INT DEFAULT NULL, createby_id INT DEFAULT NULL, INDEX IDX_14F389A859027487 (theme_id), INDEX IDX_14F389A87663CD76 (createby_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE conf_conferencier (conf_id INT NOT NULL, conferencier_id INT NOT NULL, INDEX IDX_82F763847FDF4958 (conf_id), INDEX IDX_82F76384F14895FB (conferencier_id), PRIMARY KEY (conf_id, conferencier_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE conferencier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE materielconf (id INT AUTO_INCREMENT NOT NULL, dateresa DATETIME NOT NULL, materiel_id INT DEFAULT NULL, conf_id INT DEFAULT NULL, INDEX IDX_7433CEB216880AAF (materiel_id), INDEX IDX_7433CEB27FDF4958 (conf_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE conf ADD CONSTRAINT FK_14F389A859027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE conf ADD CONSTRAINT FK_14F389A87663CD76 FOREIGN KEY (createby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conf_conferencier ADD CONSTRAINT FK_82F763847FDF4958 FOREIGN KEY (conf_id) REFERENCES conf (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conf_conferencier ADD CONSTRAINT FK_82F76384F14895FB FOREIGN KEY (conferencier_id) REFERENCES conferencier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materielconf ADD CONSTRAINT FK_7433CEB216880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE materielconf ADD CONSTRAINT FK_7433CEB27FDF4958 FOREIGN KEY (conf_id) REFERENCES conf (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf DROP FOREIGN KEY FK_14F389A859027487');
        $this->addSql('ALTER TABLE conf DROP FOREIGN KEY FK_14F389A87663CD76');
        $this->addSql('ALTER TABLE conf_conferencier DROP FOREIGN KEY FK_82F763847FDF4958');
        $this->addSql('ALTER TABLE conf_conferencier DROP FOREIGN KEY FK_82F76384F14895FB');
        $this->addSql('ALTER TABLE materielconf DROP FOREIGN KEY FK_7433CEB216880AAF');
        $this->addSql('ALTER TABLE materielconf DROP FOREIGN KEY FK_7433CEB27FDF4958');
        $this->addSql('DROP TABLE conf');
        $this->addSql('DROP TABLE conf_conferencier');
        $this->addSql('DROP TABLE conferencier');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE materielconf');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
