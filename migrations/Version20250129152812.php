<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250129152812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT DEFAULT NULL, equipe1_id INT DEFAULT NULL, equipe2_id INT DEFAULT NULL, score1 SMALLINT NOT NULL, score2 SMALLINT NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_460C35EDF607770A (tournoi_id), INDEX IDX_460C35ED4265900C (equipe1_id), INDEX IDX_460C35ED50D03FE2 (equipe2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDF607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED4265900C FOREIGN KEY (equipe1_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED50D03FE2 FOREIGN KEY (equipe2_id) REFERENCES equipe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDF607770A');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED4265900C');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED50D03FE2');
        $this->addSql('DROP TABLE rencontre');
    }
}
