CREATE TABLE Materials (
    material_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    material_name VARCHAR(255) NOT NULL,
    quantity INT(10) NOT NULL, 
    material_type INT(10) NOT NULL);

ALTER TABLE Materials DROP COLUMN material_type;
ALTER TABLE Materials ADD COLUMN material_type INT(10)NOT NULL;
ALTER TABLE Materials ADD COLUMN material_unit VARCHAR(255)NOT NULL;

ALTER TABLE materials ADD supplier_id INT(10) not null;

