<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250129151941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT DEFAULT NULL, cree_par_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2449BA15F607770A (tournoi_id), INDEX IDX_2449BA15FC29C013 (cree_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur_equipe (joueur_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_CDF2AA99A9E2D76C (joueur_id), INDEX IDX_CDF2AA996D861B89 (equipe_id), PRIMARY KEY(joueur_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (id INT AUTO_INCREMENT NOT NULL, cree_par_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date DATETIME NOT NULL, type VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_18AFD9DFFC29C013 (cree_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15F607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FC29C013 FOREIGN KEY (cree_par_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE joueur_equipe ADD CONSTRAINT FK_CDF2AA99A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur_equipe ADD CONSTRAINT FK_CDF2AA996D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFFC29C013 FOREIGN KEY (cree_par_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15F607770A');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FC29C013');
        $this->addSql('ALTER TABLE joueur_equipe DROP FOREIGN KEY FK_CDF2AA99A9E2D76C');
        $this->addSql('ALTER TABLE joueur_equipe DROP FOREIGN KEY FK_CDF2AA996D861B89');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFFC29C013');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE joueur_equipe');
        $this->addSql('DROP TABLE tournoi');
    }
}
