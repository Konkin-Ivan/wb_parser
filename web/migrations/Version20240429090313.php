<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429090313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedbacks ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedbacks ADD CONSTRAINT FK_7E6C3F894584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_7E6C3F894584665A ON feedbacks (product_id)');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AD249A887');
        $this->addSql('DROP INDEX IDX_B3BA5A5AD249A887 ON products');
        $this->addSql('ALTER TABLE products DROP feedback_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedbacks DROP FOREIGN KEY FK_7E6C3F894584665A');
        $this->addSql('DROP INDEX IDX_7E6C3F894584665A ON feedbacks');
        $this->addSql('ALTER TABLE feedbacks DROP product_id');
        $this->addSql('ALTER TABLE products ADD feedback_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AD249A887 FOREIGN KEY (feedback_id) REFERENCES feedbacks (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AD249A887 ON products (feedback_id)');
    }
}
