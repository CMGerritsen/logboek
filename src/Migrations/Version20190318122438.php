<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318122438 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE logboek (id INT AUTO_INCREMENT NOT NULL, begeleidingsbrief VARCHAR(255) DEFAULT NULL, datum DATE NOT NULL, aantalm3 INT NOT NULL, laadlocatie VARCHAR(255) NOT NULL, tijdvertrek TIME NOT NULL, bestemming VARCHAR(255) NOT NULL, evenement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE truck (id INT AUTO_INCREMENT NOT NULL, kenteken VARCHAR(255) NOT NULL, merk VARCHAR(255) DEFAULT NULL, bouwjaar DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_user ADD chauffeur_id INT NOT NULL, ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A647985C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES logboek (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64799D86650F FOREIGN KEY (user_id_id) REFERENCES logboek (id)');
        $this->addSql('CREATE INDEX IDX_957A647985C0B3BE ON fos_user (chauffeur_id)');
        $this->addSql('CREATE INDEX IDX_957A64799D86650F ON fos_user (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A647985C0B3BE');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64799D86650F');
        $this->addSql('DROP TABLE logboek');
        $this->addSql('DROP TABLE truck');
        $this->addSql('DROP INDEX IDX_957A647985C0B3BE ON fos_user');
        $this->addSql('DROP INDEX IDX_957A64799D86650F ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP chauffeur_id, DROP user_id_id');
    }
}
