# Smart Multi-Restaurant Delivery Aggregation Platform

IT306 – Server-Side Programming Project

## Project Overview

This project is a PHP and MySQL-based food delivery aggregation platform developed for the IT306 Server-Side Programming course.

The system allows users to browse restaurants, filter and search them, add products from multiple restaurants into a single cart (only if they belong to the same delivery zone), create orders, and automatically assign the most suitable courier using explainable rule-based logic.

The main focus of the project is explainability, validation, and transparent decision-making.

---

# Features

## Restaurant Module

* Restaurant listing
* Add restaurant
* Edit restaurant
* Delete restaurant
* Search restaurants by name
* Filter restaurants by category
* Filter restaurants by delivery zone
* Explainability messages for active filters

## Product & Menu Module

* Dynamic restaurant menu system
* Add products to restaurants
* Product listing by restaurant
* Add products to cart

## Cart & Order Module

* Session-based cart system
* Multi-restaurant cart support
* Zone validation rule
* Order creation
* Order item storage
* Cart total calculation
* Remove items from cart

## Courier Module

* Courier listing
* Add courier
* Edit courier
* Delete courier
* Filter couriers by zone and availability
* Automatic courier assignment
* Assignment explainability

## Authentication

* User registration
* User login
* User logout
* Password hashing
* Session management

## Security

* Prepared statements for secure database operations
* Basic server-side validation
* Input sanitization using prepared queries

---

# Technologies Used

* PHP
* MySQL
* HTML
* CSS
* XAMPP
* Git & GitHub

---

# Database Tables

## Core Tables

* users
* restaurants
* couriers
* products
* orders
* order_items

---

# Business Rules

## Zone Rule

Orders can include products only from restaurants within the same delivery zone.

Example:

* Restaurant A → Zone A

* Restaurant B → Zone A
  ✔ Can be grouped into one order

* Restaurant C → Zone B
  ❌ Cannot be added to the same cart

## Courier Assignment Rules

The system assigns couriers according to these rules:

1. Courier must operate in the same delivery zone
2. Courier must be available
3. Courier with the lowest active order count is selected

---

# Explainability Examples

## Search & Filter Explainability

* “Filtering by category: Italian”
* “Showing restaurants in zone: A”
* “Search results for: Burger”

## Validation Explainability

* “Cannot add item - different zone!”
* “Cart is empty.”

## Courier Assignment Explainability

* “Courier assigned because they are available, in the same zone, and have the lowest active order count.”

---

# How to Run the Project

## 1. Start XAMPP

Start:

* Apache
* MySQL

## 2. Place Project Folder

Move the project folder into:

```text
htdocs/
```

Example:

```text
C:\xampp\htdocs\IT306_project
```

---

## 3. Create Database

Open phpMyAdmin and create a database named:

```sql
IT306_db
```

---

## 4. Run Setup Files

Run these files in the browser:

```text
setup.php
restaurants_table.php
couriers_table.php
users_table.php
```

---

## 5. Open the Project

```text
http://localhost/IT306_project/login.php
```

---

# Demo Flow

1. Register a new user
2. Login
3. Browse restaurants
4. Search/filter restaurants
5. Open restaurant menu
6. Add products to cart
7. Test zone validation
8. Create order
9. Assign courier
10. Observe explainability messages

---

# Folder Structure

```text
IT306_project/
│
├── login.php
├── register.php
├── logout.php
├── restaurants.php
├── couriers.php
├── cart.php
├── view_cart.php
├── create_order.php
├── assign_courier.php
├── db.php
├── setup.php
│
├── restaurants/
│   ├── add_restaurant.php
│   ├── edit_restaurant.php
│   ├── delete_restaurant.php
│   ├── restaurant_menu.php
│
├── couriers/
│   ├── add_courier.php
│   ├── edit_courier.php
│   ├── delete_courier.php
```

---

# Contributors

* Muhammed Talha Navruz
* Sude Yerekonmaz
* Sena Saldıran
* Eda Atılgan

---

