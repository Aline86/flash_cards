<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200721092014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polonais ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE polonais ADD CONSTRAINT FK_3F078C0759027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_3F078C0759027487 ON polonais (theme_id)');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E7082AADBACD');
        $this->addSql('DROP INDEX fk_9775e7082aadbacd ON theme');
        $this->addSql('CREATE INDEX IDX_9775E7082AADBACD ON theme (langue_id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E7082AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polonais DROP FOREIGN KEY FK_3F078C0759027487');
        $this->addSql('DROP INDEX IDX_3F078C0759027487 ON polonais');
        $this->addSql('ALTER TABLE polonais DROP theme_id');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E7082AADBACD');
        $this->addSql('DROP INDEX idx_9775e7082aadbacd ON theme');
        $this->addSql('CREATE INDEX FK_9775E7082AADBACD ON theme (langue_id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E7082AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
    }
}
