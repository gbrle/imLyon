<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191026233218 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, demain_we_art_id INT NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_497DD63483C566D2 (demain_we_art_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demain_we_art (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, couleur VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, photo LONGTEXT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, INDEX IDX_52743D7BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD63483C566D2 FOREIGN KEY (demain_we_art_id) REFERENCES demain_we_art (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD63483C566D2');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE demain_we_art');
        $this->addSql('DROP TABLE sous_categorie');
    }
}
