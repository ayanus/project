CREATE TABLE Material_useDetail (
    mat_use_dt_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    material_id INT(10) UNSIGNED NOT NULL,
    production_dt_id INT(10) UNSIGNED NOT NULL,
    FOREIGN KEY (material_id) REFERENCES Materials(material_id) ON DELETE CASCADE,
    FOREIGN KEY (production_dt_id) REFERENCES ProductionDetail(production_dt_id) ON DELETE CASCADE);
