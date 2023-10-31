<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031121202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quota (id INT AUTO_INCREMENT NOT NULL, specie_id INT NOT NULL, society_id INT DEFAULT NULL, season_id INT DEFAULT NULL, number INT NOT NULL, UNIQUE INDEX UNIQ_6C1C0FEDD5436AB7 (specie_id), INDEX IDX_6C1C0FEDE6389D24 (society_id), UNIQUE INDEX UNIQ_6C1C0FED4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season_specie (season_id INT NOT NULL, specie_id INT NOT NULL, INDEX IDX_1C53F7C04EC001D1 (season_id), INDEX IDX_1C53F7C0D5436AB7 (specie_id), PRIMARY KEY(season_id, specie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quota ADD CONSTRAINT FK_6C1C0FEDE6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('ALTER TABLE quota ADD CONSTRAINT FK_6C1C0FED4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE season_specie ADD CONSTRAINT FK_1C53F7C04EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season_specie ADD CONSTRAINT FK_1C53F7C0D5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `kill` ADD specie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `kill` ADD CONSTRAINT FK_7295669D5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7295669D5436AB7 ON `kill` (specie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quota DROP FOREIGN KEY FK_6C1C0FEDE6389D24');
        $this->addSql('ALTER TABLE quota DROP FOREIGN KEY FK_6C1C0FED4EC001D1');
        $this->addSql('ALTER TABLE season_specie DROP FOREIGN KEY FK_1C53F7C04EC001D1');
        $this->addSql('ALTER TABLE season_specie DROP FOREIGN KEY FK_1C53F7C0D5436AB7');
        $this->addSql('DROP TABLE quota');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE season_specie');
        $this->addSql('ALTER TABLE `kill` DROP FOREIGN KEY FK_7295669D5436AB7');
        $this->addSql('DROP INDEX UNIQ_7295669D5436AB7 ON `kill`');
        $this->addSql('ALTER TABLE `kill` DROP specie_id');
    }
}
