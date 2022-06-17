<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617201330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE number number INT NOT NULL, CHANGE synopsis synopsis LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE episode RENAME INDEX fk_episode_season TO IDX_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE program DROP country, DROP year');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92ED77842B36786B ON program (title)');
        $this->addSql('ALTER TABLE season CHANGE program_id program_id INT NOT NULL, CHANGE number number INT NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE season RENAME INDEX fk_season_program TO IDX_F0E45BA93EB8070A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE number number INT DEFAULT NULL, CHANGE synopsis synopsis TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE episode RENAME INDEX idx_ddaa1cda4ec001d1 TO fk_episode_season');
        $this->addSql('DROP INDEX UNIQ_92ED77842B36786B ON program');
        $this->addSql('ALTER TABLE program ADD country VARCHAR(100) DEFAULT NULL, ADD year INT DEFAULT NULL');
        $this->addSql('ALTER TABLE season CHANGE program_id program_id INT DEFAULT NULL, CHANGE number number INT DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE season RENAME INDEX idx_f0e45ba93eb8070a TO fk_season_program');
    }
}
