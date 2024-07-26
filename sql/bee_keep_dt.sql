CREATE TABLE Beekeep_Detail (
   b_keep_dt_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   b_keeping INT(10) UNSIGNED NOT NULL,
   bee_id INT(10) UNSIGNED NOT NULL,
   employee_id INT(10) UNSIGNED NOT NULL,
   quantity INT(50) NOT NULL,
   date DATETIME NOT NULL,
   FOREIGN KEY (b_keeping) REFERENCES Beekeeping(b_keeping) ON DELETE CASCADE,
   FOREIGN KEY (bee_id) REFERENCES Bee(bee_id) ON DELETE CASCADE,
   FOREIGN KEY (employee_id) REFERENCES Employee(employee_id) ON DELETE CASCADE);
