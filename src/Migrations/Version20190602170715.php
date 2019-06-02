<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602170715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vegetal ADD mangeurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vegetal ADD CONSTRAINT FK_61DBFF36194A9C6 FOREIGN KEY (mangeurs_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_61DBFF36194A9C6 ON vegetal (mangeurs_id)');
        $this->addSql('ALTER TABLE fruit DROP FOREIGN KEY FK_A00BD29736C637D0');
        $this->addSql('DROP INDEX IDX_A00BD29736C637D0 ON fruit');
        $this->addSql('ALTER TABLE fruit DROP mangeur_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fruit ADD mangeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fruit ADD CONSTRAINT FK_A00BD29736C637D0 FOREIGN KEY (mangeur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A00BD29736C637D0 ON fruit (mangeur_id)');
        $this->addSql('ALTER TABLE vegetal DROP FOREIGN KEY FK_61DBFF36194A9C6');
        $this->addSql('DROP INDEX IDX_61DBFF36194A9C6 ON vegetal');
        $this->addSql('ALTER TABLE vegetal DROP mangeurs_id');
    }
}
