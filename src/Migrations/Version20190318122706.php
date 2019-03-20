<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318122706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

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
        $this->addSql('DROP INDEX IDX_957A647985C0B3BE ON fos_user');
        $this->addSql('DROP INDEX IDX_957A64799D86650F ON fos_user');
    }
}
