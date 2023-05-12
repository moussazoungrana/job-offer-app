<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512081858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_offer_category (job_offer_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(job_offer_id, category_id))');
        $this->addSql('CREATE INDEX IDX_ED48F9663481D195 ON job_offer_category (job_offer_id)');
        $this->addSql('CREATE INDEX IDX_ED48F96612469DE2 ON job_offer_category (category_id)');
        $this->addSql('ALTER TABLE job_offer_category ADD CONSTRAINT FK_ED48F9663481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_offer_category ADD CONSTRAINT FK_ED48F96612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE job_offer_category DROP CONSTRAINT FK_ED48F9663481D195');
        $this->addSql('ALTER TABLE job_offer_category DROP CONSTRAINT FK_ED48F96612469DE2');
        $this->addSql('DROP TABLE job_offer_category');
    }
}
