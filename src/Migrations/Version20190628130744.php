<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628130744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vegetal (id INT AUTO_INCREMENT NOT NULL, mangeur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, is_update TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_61DBFF3989D9B62 (slug), INDEX IDX_61DBFF336C637D0 (mangeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE arbre (id INT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decomposeur (id INT AUTO_INCREMENT NOT NULL, debris VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fleur (id INT NOT NULL, bouquet VARCHAR(255) DEFAULT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fruit (id INT NOT NULL, arbre_id INT NOT NULL, salade VARCHAR(255) DEFAULT NULL, INDEX IDX_A00BD2975142B8A3 (arbre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, discr VARCHAR(255) NOT NULL, outil VARCHAR(255) DEFAULT NULL, mission VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jardinier_vegetal (jardinier_id INT NOT NULL, vegetal_id INT NOT NULL, INDEX IDX_B9D46C6EE9EBD041 (jardinier_id), INDEX IDX_B9D46C6ED198D611 (vegetal_id), PRIMARY KEY(jardinier_id, vegetal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legume (id INT NOT NULL, taille VARCHAR(255) NOT NULL, soupe VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legume_fleur (legume_id INT NOT NULL, fleur_id INT NOT NULL, INDEX IDX_5464763B25F18E37 (legume_id), INDEX IDX_5464763BE8DD5A7 (fleur_id), PRIMARY KEY(legume_id, fleur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pollinisateur (id INT AUTO_INCREMENT NOT NULL, fleur VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('ALTER TABLE vegetal ADD CONSTRAINT FK_61DBFF336C637D0 FOREIGN KEY (mangeur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE arbre ADD CONSTRAINT FK_C8C4501ABF396750 FOREIGN KEY (id) REFERENCES vegetal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fleur ADD CONSTRAINT FK_3FFA923BF396750 FOREIGN KEY (id) REFERENCES vegetal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fruit ADD CONSTRAINT FK_A00BD2975142B8A3 FOREIGN KEY (arbre_id) REFERENCES arbre (id)');
        $this->addSql('ALTER TABLE fruit ADD CONSTRAINT FK_A00BD297BF396750 FOREIGN KEY (id) REFERENCES vegetal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jardinier_vegetal ADD CONSTRAINT FK_B9D46C6EE9EBD041 FOREIGN KEY (jardinier_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jardinier_vegetal ADD CONSTRAINT FK_B9D46C6ED198D611 FOREIGN KEY (vegetal_id) REFERENCES vegetal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legume ADD CONSTRAINT FK_86667383BF396750 FOREIGN KEY (id) REFERENCES vegetal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legume_fleur ADD CONSTRAINT FK_5464763B25F18E37 FOREIGN KEY (legume_id) REFERENCES legume (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legume_fleur ADD CONSTRAINT FK_5464763BE8DD5A7 FOREIGN KEY (fleur_id) REFERENCES fleur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE arbre DROP FOREIGN KEY FK_C8C4501ABF396750');
        $this->addSql('ALTER TABLE fleur DROP FOREIGN KEY FK_3FFA923BF396750');
        $this->addSql('ALTER TABLE fruit DROP FOREIGN KEY FK_A00BD297BF396750');
        $this->addSql('ALTER TABLE jardinier_vegetal DROP FOREIGN KEY FK_B9D46C6ED198D611');
        $this->addSql('ALTER TABLE legume DROP FOREIGN KEY FK_86667383BF396750');
        $this->addSql('ALTER TABLE fruit DROP FOREIGN KEY FK_A00BD2975142B8A3');
        $this->addSql('ALTER TABLE legume_fleur DROP FOREIGN KEY FK_5464763BE8DD5A7');
        $this->addSql('ALTER TABLE vegetal DROP FOREIGN KEY FK_61DBFF336C637D0');
        $this->addSql('ALTER TABLE jardinier_vegetal DROP FOREIGN KEY FK_B9D46C6EE9EBD041');
        $this->addSql('ALTER TABLE legume_fleur DROP FOREIGN KEY FK_5464763B25F18E37');
        $this->addSql('DROP TABLE vegetal');
        $this->addSql('DROP TABLE arbre');
        $this->addSql('DROP TABLE decomposeur');
        $this->addSql('DROP TABLE fleur');
        $this->addSql('DROP TABLE fruit');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE jardinier_vegetal');
        $this->addSql('DROP TABLE legume');
        $this->addSql('DROP TABLE legume_fleur');
        $this->addSql('DROP TABLE pollinisateur');
        $this->addSql('DROP TABLE ext_translations');
    }
}
