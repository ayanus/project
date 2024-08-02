CREATE TABLE SalesDetail (
    sales_dt_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sales_id INT(10) UNSIGNED NOT NULL,
    product_id INT(10) UNSIGNED NOT NULL,
    quantity INT(10) NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (sales_id) REFERENCES Sales(sales_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE);