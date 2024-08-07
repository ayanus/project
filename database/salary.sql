CREATE TABLE Salary (
   salary_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   employee_id INT(10) UNSIGNED NOT NULL,
   date DATETIME NOT NULL,
   money VARCHAR(255) NOT NULL,
   status VARCHAR(50) NOT NULL,
   FOREIGN KEY (employee_id) REFERENCES Employee(employee_id) ON DELETE CASCADE);
