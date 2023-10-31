<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031134429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE federation ADD department_id INT NOT NULL');
        $this->addSql('ALTER TABLE federation ADD CONSTRAINT FK_AD241BCDAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AD241BCDAE80F5DF ON federation (department_id)');
        $this->addSql('ALTER TABLE society ADD federation_id INT NOT NULL');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F26A03EFC5 FOREIGN KEY (federation_id) REFERENCES federation (id)');
        $this->addSql('CREATE INDEX IDX_D6461F26A03EFC5 ON society (federation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE federation DROP FOREIGN KEY FK_AD241BCDAE80F5DF');
        $this->addSql('DROP INDEX UNIQ_AD241BCDAE80F5DF ON federation');
        $this->addSql('ALTER TABLE federation DROP department_id');
        $this->addSql('ALTER TABLE society DROP FOREIGN KEY FK_D6461F26A03EFC5');
        $this->addSql('DROP INDEX IDX_D6461F26A03EFC5 ON society');
        $this->addSql('ALTER TABLE society DROP federation_id');
    }
}
