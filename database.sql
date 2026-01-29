CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  surname VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  username VARCHAR(80) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  plan VARCHAR(30) NOT NULL DEFAULT 'Free',
  balance DECIMAL(12,2) NOT NULL DEFAULT 0,
  trial_start DATETIME NULL,
  trial_end DATETIME NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE companies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  inn VARCHAR(20) NULL,
  address VARCHAR(255) NULL,
  owner_user_id INT NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE company_users (
  company_id INT NOT NULL,
  user_id INT NOT NULL,
  role VARCHAR(20) NOT NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (company_id, user_id)
);

CREATE TABLE warehouses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  address VARCHAR(255) NULL,
  comment VARCHAR(255) NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  name VARCHAR(150) NOT NULL
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  category_id INT NULL,
  name VARCHAR(150) NOT NULL,
  article VARCHAR(80) NOT NULL,
  sku VARCHAR(80) NOT NULL,
  barcode VARCHAR(120) NULL,
  unit VARCHAR(30) NOT NULL,
  price DECIMAL(12,2) NOT NULL,
  cost DECIMAL(12,2) NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL
);

CREATE TABLE stock_balances (
  warehouse_id INT NOT NULL,
  product_id INT NOT NULL,
  qty DECIMAL(14,3) NOT NULL DEFAULT 0,
  PRIMARY KEY (warehouse_id, product_id)
);

CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  base_price DECIMAL(12,2) NOT NULL,
  comment VARCHAR(255) NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL
);

CREATE TABLE receipts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  warehouse_id INT NOT NULL,
  doc_no VARCHAR(50) NOT NULL,
  date DATE NOT NULL,
  supplier VARCHAR(150) NULL,
  comment VARCHAR(255) NULL,
  status VARCHAR(30) NOT NULL,
  total DECIMAL(12,2) NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE receipt_items (
  receipt_id INT NOT NULL,
  product_id INT NOT NULL,
  qty DECIMAL(14,3) NOT NULL,
  price DECIMAL(12,2) NOT NULL
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  warehouse_id INT NOT NULL,
  doc_no VARCHAR(50) NOT NULL,
  date DATE NOT NULL,
  client_name VARCHAR(150) NOT NULL,
  payment_type VARCHAR(30) NOT NULL,
  status VARCHAR(30) NOT NULL,
  discount DECIMAL(12,2) NULL,
  total DECIMAL(12,2) NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE order_items (
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  qty DECIMAL(14,3) NOT NULL,
  price DECIMAL(12,2) NOT NULL
);

CREATE TABLE order_services (
  order_id INT NOT NULL,
  service_id INT NOT NULL,
  qty DECIMAL(14,3) NOT NULL,
  price DECIMAL(12,2) NOT NULL,
  duration_minutes INT NOT NULL
);

CREATE TABLE invitations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_id INT NOT NULL,
  inviter_user_id INT NOT NULL,
  invitee_email VARCHAR(150) NOT NULL,
  role VARCHAR(20) NOT NULL,
  status VARCHAR(20) NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  type VARCHAR(30) NOT NULL,
  title VARCHAR(150) NOT NULL,
  body VARCHAR(255) NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL,
  meta_json TEXT NULL
);
