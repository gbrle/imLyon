<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191027130406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, titre LONGTEXT DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, descriptif LONGTEXT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, photo LONGTEXT DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_categorie DROP description, DROP prenom, DROP nom, DROP photo, DROP contenu');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article');
        $this->addSql('ALTER TABLE sous_categorie ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD prenom VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD nom VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD photo LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD contenu LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
