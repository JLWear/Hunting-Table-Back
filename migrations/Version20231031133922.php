<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031133922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hunter DROP city, DROP description');
        $this->addSql('ALTER TABLE quota ADD CONSTRAINT FK_6C1C0FEDD5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id)');
        $this->addSql('ALTER TABLE society DROP city, DROP description');
        $this->addSql('ALTER TABLE user ADD city VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE society ADD city VARCHAR(255) NOT NULL, ADD description VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE hunter ADD city VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE quota DROP FOREIGN KEY FK_6C1C0FEDD5436AB7');
        $this->addSql('ALTER TABLE `user` DROP city, DROP description');
    }
}
