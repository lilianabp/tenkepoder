-- Doctrine Migration File Generated on 2020-07-15 13:41:34

-- Version 20200715113350
DROP TABLE ext_translations;
DROP TABLE service_translations;
ALTER TABLE client ADD name_en VARCHAR(255) NOT NULL, ADD description_en LONGTEXT NOT NULL;
ALTER TABLE service ADD name_en VARCHAR(255) NOT NULL, ADD abstract_en LONGTEXT NOT NULL, ADD wp1_title_en VARCHAR(255) NOT NULL, ADD wp1_desc_en VARCHAR(255) DEFAULT NULL, ADD wp2_title_en VARCHAR(255) DEFAULT NULL, ADD wp2_desc_en VARCHAR(255) DEFAULT NULL, ADD wp3_title_en VARCHAR(255) DEFAULT NULL, ADD wp3_desc_en VARCHAR(255) DEFAULT NULL, ADD description_en LONGTEXT DEFAULT NULL;
ALTER TABLE project ADD name_en VARCHAR(255) NOT NULL, ADD description_en LONGTEXT NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200715113350', CURRENT_TIMESTAMP);
