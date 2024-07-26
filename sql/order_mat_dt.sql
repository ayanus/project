CREATE TABLE OrderMat_Detail (
    OrderMat_dt_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    OrderMat_id INT(11) UNSIGNED NOT NULL,
    material_id INT(11) UNSIGNED NOT NULL,
    quantity INT(10) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (OrderMat_id) REFERENCES OrderMaterials(OrderMat_id) ON DELETE CASCADE,
    FOREIGN KEY (material_id) REFERENCES Materials(material_id) ON DELETE CASCADE);
