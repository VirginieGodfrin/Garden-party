<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603161531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jardinier_vegetal (jardinier_id INT NOT NULL, vegetal_id INT NOT NULL, INDEX IDX_B9D46C6EE9EBD041 (jardinier_id), INDEX IDX_B9D46C6ED198D611 (vegetal_id), PRIMARY KEY(jardinier_id, vegetal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jardinier_vegetal ADD CONSTRAINT FK_B9D46C6EE9EBD041 FOREIGN KEY (jardinier_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jardinier_vegetal ADD CONSTRAINT FK_B9D46C6ED198D611 FOREIGN KEY (vegetal_id) REFERENCES vegetal (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE jardinier_vegetal');
    }
}
