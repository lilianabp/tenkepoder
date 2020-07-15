<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715113350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE service_translations');
        $this->addSql('ALTER TABLE client ADD name_en VARCHAR(255) NOT NULL, ADD description_en LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE service ADD name_en VARCHAR(255) NOT NULL, ADD abstract_en LONGTEXT NOT NULL, ADD wp1_title_en VARCHAR(255) NOT NULL, ADD wp1_desc_en VARCHAR(255) DEFAULT NULL, ADD wp2_title_en VARCHAR(255) DEFAULT NULL, ADD wp2_desc_en VARCHAR(255) DEFAULT NULL, ADD wp3_title_en VARCHAR(255) DEFAULT NULL, ADD wp3_desc_en VARCHAR(255) DEFAULT NULL, ADD description_en LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD name_en VARCHAR(255) NOT NULL, ADD description_en LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, object_class VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, field VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, foreign_key VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service_translations (id INT AUTO_INCREMENT NOT NULL, object_id INT DEFAULT NULL, locale VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, field VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX lookup_unique_idx (locale, object_id, field), INDEX IDX_191BAF62232D562B (object_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE service_translations ADD CONSTRAINT FK_191BAF62232D562B FOREIGN KEY (object_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client DROP name_en, DROP description_en');
        $this->addSql('ALTER TABLE project DROP name_en, DROP description_en');
        $this->addSql('ALTER TABLE service DROP name_en, DROP abstract_en, DROP wp1_title_en, DROP wp1_desc_en, DROP wp2_title_en, DROP wp2_desc_en, DROP wp3_title_en, DROP wp3_desc_en, DROP description_en');
    }
}
