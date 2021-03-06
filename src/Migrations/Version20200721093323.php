<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200721093323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE allemand ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE allemand ADD CONSTRAINT FK_2A69036059027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_2A69036059027487 ON allemand (theme_id)');
        $this->addSql('ALTER TABLE espagnol ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE espagnol ADD CONSTRAINT FK_CD009BB759027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_CD009BB759027487 ON espagnol (theme_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE allemand DROP FOREIGN KEY FK_2A69036059027487');
        $this->addSql('DROP INDEX IDX_2A69036059027487 ON allemand');
        $this->addSql('ALTER TABLE allemand DROP theme_id');
        $this->addSql('ALTER TABLE espagnol DROP FOREIGN KEY FK_CD009BB759027487');
        $this->addSql('DROP INDEX IDX_CD009BB759027487 ON espagnol');
        $this->addSql('ALTER TABLE espagnol DROP theme_id');
    }
}
