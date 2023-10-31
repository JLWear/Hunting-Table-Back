<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031114053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE federation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hunt (id INT AUTO_INCREMENT NOT NULL, hunter_id INT DEFAULT NULL, society_id INT NOT NULL, date DATE NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(500) DEFAULT NULL, INDEX IDX_21FA5947A7DC5C81 (hunter_id), INDEX IDX_21FA5947E6389D24 (society_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hunt_hunter (hunt_id INT NOT NULL, hunter_id INT NOT NULL, INDEX IDX_3C3F9892585A34B (hunt_id), INDEX IDX_3C3F989A7DC5C81 (hunter_id), PRIMARY KEY(hunt_id, hunter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hunter (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `kill` (id INT AUTO_INCREMENT NOT NULL, hunt_id INT NOT NULL, number INT NOT NULL, INDEX IDX_72956692585A34B (hunt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specie (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A28097212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hunt ADD CONSTRAINT FK_21FA5947A7DC5C81 FOREIGN KEY (hunter_id) REFERENCES hunter (id)');
        $this->addSql('ALTER TABLE hunt ADD CONSTRAINT FK_21FA5947E6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('ALTER TABLE hunt_hunter ADD CONSTRAINT FK_3C3F9892585A34B FOREIGN KEY (hunt_id) REFERENCES hunt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hunt_hunter ADD CONSTRAINT FK_3C3F989A7DC5C81 FOREIGN KEY (hunter_id) REFERENCES hunter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `kill` ADD CONSTRAINT FK_72956692585A34B FOREIGN KEY (hunt_id) REFERENCES hunt (id)');
        $this->addSql('ALTER TABLE specie ADD CONSTRAINT FK_A28097212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user ADD hunter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A7DC5C81 FOREIGN KEY (hunter_id) REFERENCES hunter (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A7DC5C81 ON user (hunter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649A7DC5C81');
        $this->addSql('ALTER TABLE hunt DROP FOREIGN KEY FK_21FA5947A7DC5C81');
        $this->addSql('ALTER TABLE hunt DROP FOREIGN KEY FK_21FA5947E6389D24');
        $this->addSql('ALTER TABLE hunt_hunter DROP FOREIGN KEY FK_3C3F9892585A34B');
        $this->addSql('ALTER TABLE hunt_hunter DROP FOREIGN KEY FK_3C3F989A7DC5C81');
        $this->addSql('ALTER TABLE `kill` DROP FOREIGN KEY FK_72956692585A34B');
        $this->addSql('ALTER TABLE specie DROP FOREIGN KEY FK_A28097212469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE federation');
        $this->addSql('DROP TABLE hunt');
        $this->addSql('DROP TABLE hunt_hunter');
        $this->addSql('DROP TABLE hunter');
        $this->addSql('DROP TABLE `kill`');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE specie');
        $this->addSql('DROP INDEX UNIQ_8D93D649A7DC5C81 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP hunter_id');
    }
}
