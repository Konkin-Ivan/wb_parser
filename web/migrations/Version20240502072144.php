<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502072144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A44F5D008');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A8FD80EEA');
        $this->addSql('DROP INDEX IDX_B3BA5A5A44F5D008 ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A8FD80EEA ON products');
        $this->addSql('ALTER TABLE products DROP brand_id, DROP volume_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD brand_id INT DEFAULT NULL, ADD volume_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A8FD80EEA FOREIGN KEY (volume_id) REFERENCES volume (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A44F5D008 ON products (brand_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A8FD80EEA ON products (volume_id)');
    }
}
