USE demo;

CREATE TABLE IF NOT EXISTS employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  role VARCHAR(50) NOT NULL,
  hired_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO employees (first_name, last_name, role) VALUES
('Alice', 'Anderson', 'Engineer'),
('Bruno', 'Bieri', 'Support'),
('Clara', 'Cahill', 'Product');
