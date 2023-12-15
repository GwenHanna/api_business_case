<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214012459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, date_created DATE NOT NULL, score INT DEFAULT NULL, INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, employee_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, payement_date DATE NOT NULL, depot_date DATE NOT NULL, pick_up_date DATE NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F52993988C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selection (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, article_id INT DEFAULT NULL, note VARCHAR(255) NOT NULL, INDEX IDX_96A50CD7ED5CA9E6 (service_id), INDEX IDX_96A50CD77294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, service_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD2AC8DE0F (service_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_type (id INT AUTO_INCREMENT NOT NULL, section_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(600) NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_429DE3C5D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, street VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, date_created DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE selection ADD CONSTRAINT FK_96A50CD7ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE selection ADD CONSTRAINT FK_96A50CD77294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2AC8DE0F FOREIGN KEY (service_type_id) REFERENCES service_type (id)');
        $this->addSql('ALTER TABLE service_type ADD CONSTRAINT FK_429DE3C5D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988C03F15C');
        $this->addSql('ALTER TABLE selection DROP FOREIGN KEY FK_96A50CD7ED5CA9E6');
        $this->addSql('ALTER TABLE selection DROP FOREIGN KEY FK_96A50CD77294869C');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2AC8DE0F');
        $this->addSql('ALTER TABLE service_type DROP FOREIGN KEY FK_429DE3C5D823E37A');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE selection');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_type');
        $this->addSql('DROP TABLE user');
    }
}