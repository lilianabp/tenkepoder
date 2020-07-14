-- Doctrine Migration File Generated on 2020-07-14 14:35:42

-- Version 20200714123519
CREATE TABLE service_project (service_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_E0378272ED5CA9E6 (service_id), INDEX IDX_E0378272166D1F9C (project_id), PRIMARY KEY(service_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
ALTER TABLE service_project ADD CONSTRAINT FK_E0378272ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE;
ALTER TABLE service_project ADD CONSTRAINT FK_E0378272166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200714123519', CURRENT_TIMESTAMP);
