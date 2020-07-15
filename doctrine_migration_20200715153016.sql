-- Doctrine Migration File Generated on 2020-07-15 15:30:16

-- Version 20200715132955
ALTER TABLE service DROP wp1_title, DROP wp1_desc, DROP wp2_title, DROP wp2_desc, DROP wp3_title, DROP wp3_desc, DROP wp1_title_en, DROP wp1_desc_en, DROP wp2_title_en, DROP wp2_desc_en, DROP wp3_title_en, DROP wp3_desc_en;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200715132955', CURRENT_TIMESTAMP);
