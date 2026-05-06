

//database name:food_delivery

//users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

//restaurants
CREATE TABLE restaurants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    category VARCHAR(100),
    zone VARCHAR(50)
);


//couriers
CREATE TABLE couriers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    zone VARCHAR(50),
    availability BOOLEAN,
    active_order_count INT DEFAULT 0
);

//orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    courier_id INT NULL,
    status VARCHAR(50),
    zone VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

//order_items
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    restaurant_id INT,
    product_name VARCHAR(100),
    price FLOAT,
    quantity INT
);