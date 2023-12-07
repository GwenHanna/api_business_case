<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206144755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_article (service_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_CDBE5CFAED5CA9E6 (service_id), INDEX IDX_CDBE5CFA7294869C (article_id), PRIMARY KEY(service_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_article ADD CONSTRAINT FK_CDBE5CFAED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_article ADD CONSTRAINT FK_CDBE5CFA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66ED5CA9E6');
        $this->addSql('DROP INDEX IDX_23A0E66ED5CA9E6 ON article');
        $this->addSql('ALTER TABLE article DROP service_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_article DROP FOREIGN KEY FK_CDBE5CFAED5CA9E6');
        $this->addSql('ALTER TABLE service_article DROP FOREIGN KEY FK_CDBE5CFA7294869C');
        $this->addSql('DROP TABLE service_article');
        $this->addSql('ALTER TABLE article ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_23A0E66ED5CA9E6 ON article (service_id)');
    }
}
