<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240706233236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, prix NUMERIC(5, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecon (id INT AUTO_INCREMENT NOT NULL, code_moniteur_id INT DEFAULT NULL, code_eleve_id INT DEFAULT NULL, immatriculation_id INT DEFAULT NULL, reglee TINYINT(1) DEFAULT NULL, rdv DATETIME DEFAULT NULL, INDEX IDX_94E6242EEB754C63 (code_moniteur_id), INDEX IDX_94E6242EF3EDBF99 (code_eleve_id), INDEX IDX_94E6242E5FD1A365 (immatriculation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licence (id INT AUTO_INCREMENT NOT NULL, code_categorie_id INT DEFAULT NULL, code_moniteur_id INT DEFAULT NULL, date_obtention DATE DEFAULT NULL, INDEX IDX_1DAAE64877DD1548 (code_categorie_id), INDEX IDX_1DAAE648EB754C63 (code_moniteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, sexe TINYINT(1) DEFAULT NULL, birthday_date DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, type_compte VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, code_categorie_id INT DEFAULT NULL, marque VARCHAR(255) DEFAULT NULL, modele VARCHAR(255) DEFAULT NULL, annee INT DEFAULT NULL, INDEX IDX_292FFF1D77DD1548 (code_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242EEB754C63 FOREIGN KEY (code_moniteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242EF3EDBF99 FOREIGN KEY (code_eleve_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242E5FD1A365 FOREIGN KEY (immatriculation_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE licence ADD CONSTRAINT FK_1DAAE64877DD1548 FOREIGN KEY (code_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE licence ADD CONSTRAINT FK_1DAAE648EB754C63 FOREIGN KEY (code_moniteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D77DD1548 FOREIGN KEY (code_categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lecon DROP FOREIGN KEY FK_94E6242EEB754C63');
        $this->addSql('ALTER TABLE lecon DROP FOREIGN KEY FK_94E6242EF3EDBF99');
        $this->addSql('ALTER TABLE lecon DROP FOREIGN KEY FK_94E6242E5FD1A365');
        $this->addSql('ALTER TABLE licence DROP FOREIGN KEY FK_1DAAE64877DD1548');
        $this->addSql('ALTER TABLE licence DROP FOREIGN KEY FK_1DAAE648EB754C63');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D77DD1548');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE lecon');
        $this->addSql('DROP TABLE licence');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
