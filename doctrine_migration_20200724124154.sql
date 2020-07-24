-- Doctrine Migration File Generated on 2020-07-24 12:41:54

-- Version 20200724104134
CREATE TABLE privacy_policy (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, text_en LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200724104134', CURRENT_TIMESTAMP);
