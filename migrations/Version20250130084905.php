<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130084905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe CHANGE tournoi_id tournoi_id INT NOT NULL, CHANGE cree_par_id cree_par_id INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD user_id INT NOT NULL, CHANGE nom username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD71A9C5F85E0677 ON joueur (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD71A9C5A76ED395 ON joueur (user_id)');
        $this->addSql('ALTER TABLE rencontre CHANGE tournoi_id tournoi_id INT NOT NULL, CHANGE equipe1_id equipe1_id INT NOT NULL, CHANGE equipe2_id equipe2_id INT NOT NULL, CHANGE score1 score1 SMALLINT DEFAULT 0 NOT NULL, CHANGE score2 score2 SMALLINT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe CHANGE tournoi_id tournoi_id INT DEFAULT NULL, CHANGE cree_par_id cree_par_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5A76ED395');
        $this->addSql('DROP INDEX UNIQ_FD71A9C5F85E0677 ON joueur');
        $this->addSql('DROP INDEX UNIQ_FD71A9C5A76ED395 ON joueur');
        $this->addSql('ALTER TABLE joueur DROP user_id, CHANGE username nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rencontre CHANGE tournoi_id tournoi_id INT DEFAULT NULL, CHANGE equipe1_id equipe1_id INT DEFAULT NULL, CHANGE equipe2_id equipe2_id INT DEFAULT NULL, CHANGE score1 score1 SMALLINT NOT NULL, CHANGE score2 score2 SMALLINT NOT NULL');
    }
}
