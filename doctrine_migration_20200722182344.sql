-- Doctrine Migration File Generated on 2020-07-22 18:23:44

-- Version 20200722162317
CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, message LONGTEXT DEFAULT NULL, privacy TINYINT(1) NOT NULL, INDEX IDX_4C62E638ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
ALTER TABLE contact ADD CONSTRAINT FK_4C62E638ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id);
DROP INDEX slug ON project;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200722162317', CURRENT_TIMESTAMP);
