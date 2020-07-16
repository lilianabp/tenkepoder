<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716121513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD23DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE service RENAME INDEX slug TO UNIQ_E19D9AD2989D9B62');
        $this->addSql('ALTER TABLE service RENAME INDEX image_id TO UNIQ_E19D9AD23DA5256D');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD23DA5256D');
        $this->addSql('ALTER TABLE service RENAME INDEX uniq_e19d9ad23da5256d TO image_id');
        $this->addSql('ALTER TABLE service RENAME INDEX uniq_e19d9ad2989d9b62 TO slug');
    }
}
