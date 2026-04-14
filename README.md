# Smart Multi-Restaurant Delivery Aggregation Platform

IT306 Server-Side Programming Project

## Project Overview
This project is a rule-based food delivery aggregation platform developed with PHP and MySQL.  
It allows users to view restaurants, search and filter them, manage couriers, and assign the most suitable courier based on simple and explainable rules.

## Features
- Restaurant listing
- Search restaurants by name
- Filter restaurants by category and zone
- Courier listing
- Filter couriers by zone and availability
- Courier assignment based on:
  - zone compatibility
  - availability
  - lowest active order count
- Explainable assignment results
- User registration
- User login and logout

## Technologies Used
- PHP
- MySQL
- HTML
- CSS
- XAMPP

## Database Tables
- `restaurants`
- `couriers`
- `users`

## Project Structure
- `index.php` → main page
- `restaurants.php` → restaurant module
- `couriers.php` → courier module
- `assign_courier.php` → courier assignment page
- `login.php` → login page
- `register.php` → user registration page
- `logout.php` → logout page
- `db.php` → database connection

## Courier Assignment Logic
The system assigns a courier according to these rules:
1. The courier must belong to the selected delivery zone.
2. The courier must be available.
3. Among eligible couriers, the one with the lowest active order count is assigned.

## Explainability
The system provides clear explanations for:
- search and filter results
- courier assignment decisions
- failed assignment cases when no courier is available

## How to Run the Project
1. Start Apache and MySQL in XAMPP.
2. Place the project folder inside `htdocs`.
3. Create the database in phpMyAdmin.
4. Run the table creation files:
   - `createdb.php`
   - `restaurants/restaurants_table.php`
   - `couriers/couriers_table.php`
   - `users_table.php`
5. Insert sample data:
   - `restaurants/insert_restaurants.php`
   - `couriers/insert_couriers.php`
6. Open the project in the browser:
   - `http://localhost/IT306_project/login.php`

## Demo Flow
1. Register a new user
2. Login
3. View and filter restaurants
4. View and filter couriers
5. Assign a courier by zone
6. Observe the explanation output

## Contributors
- Muhammed Talha Navruz
- Sude Yerekonmaz
- Sena Saldıran
- Eda Atılgan
