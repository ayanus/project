CREATE TABLE product_recipes (
    recipe_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    product_id INT(10)UNSIGNED,           -- อ้างอิงถึงสินค้าที่จะผลิต
    material_id INT(10)UNSIGNED,        -- อ้างอิงถึงวัตถุดิบ
    quantity_required DECIMAL(10, 2),  -- ปริมาณที่ใช้
    unit VARCHAR(50),         -- หน่วย เช่น กรัม, มิลลิลิตร
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (material_id) REFERENCES materials(material_id)
);

ALTER TABLE product_recipes ADD COLUMN b_keep_dt_id INT(10) UNSIGNED;

ALTER TABLE product_recipes
ADD CONSTRAINT fk_beekeep_detail
FOREIGN KEY (b_keep_dt_id) REFERENCES beekeep_detail(b_keep_dt_id);

ALTER TABLE product_recipes
ADD COLUMN product_bee_id INT(10),
ADD CONSTRAINT fk_product_bee
FOREIGN KEY (product_bee_id) REFERENCES product_bee(product_bee_id);

INSERT INTO product_recipes (product_id, material_id, product_bee_id, quantity_required, unit)
VALUES (5, 66, 1, 150, 'มิลลิลิตร'),
       (6, 66, 1, 150, 'มิลลิลิตร'),
       (7, 66, 1, 150, 'มิลลิลิตร'),
       (8, 66, 1, 150, 'มิลลิลิตร');

