<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130151338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, cree_par_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2449BA15F607770A (tournoi_id), INDEX IDX_2449BA15FC29C013 (cree_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FD71A9C5F85E0677 (username), UNIQUE INDEX UNIQ_FD71A9C5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur_equipe (joueur_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_CDF2AA99A9E2D76C (joueur_id), INDEX IDX_CDF2AA996D861B89 (equipe_id), PRIMARY KEY(joueur_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, equipe1_id INT NOT NULL, equipe2_id INT NOT NULL, score1 SMALLINT DEFAULT 0 NOT NULL, score2 SMALLINT DEFAULT 0 NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_460C35EDF607770A (tournoi_id), INDEX IDX_460C35ED4265900C (equipe1_id), INDEX IDX_460C35ED50D03FE2 (equipe2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (id INT AUTO_INCREMENT NOT NULL, cree_par_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date DATETIME NOT NULL, type VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_18AFD9DFFC29C013 (cree_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15F607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FC29C013 FOREIGN KEY (cree_par_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE joueur_equipe ADD CONSTRAINT FK_CDF2AA99A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur_equipe ADD CONSTRAINT FK_CDF2AA996D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDF607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED4265900C FOREIGN KEY (equipe1_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED50D03FE2 FOREIGN KEY (equipe2_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFFC29C013 FOREIGN KEY (cree_par_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15F607770A');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FC29C013');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5A76ED395');
        $this->addSql('ALTER TABLE joueur_equipe DROP FOREIGN KEY FK_CDF2AA99A9E2D76C');
        $this->addSql('ALTER TABLE joueur_equipe DROP FOREIGN KEY FK_CDF2AA996D861B89');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDF607770A');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED4265900C');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED50D03FE2');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFFC29C013');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE joueur_equipe');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON `user`');
        $this->addSql('ALTER TABLE `user` CHANGE username username VARCHAR(255) NOT NULL');
    }
}
