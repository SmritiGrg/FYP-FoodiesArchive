# FYP-FoodiesArchive

## Table Of Contents

- [About The Project](#about-the-project)
- [Key Features](#key-features)
- [Folder Structure](#folder-structure)
- [Installation and Setup Guide](#installation-and-setup-guide)

# About the Project
Foodie's Archive (Website) which is a comprehensive food website built using PHP and laravel as its framework, a platform showcasing Nepal’s diverse foods, drinks, eateries, restaurants, etc. with their reviews, location, and likes. For this project I will be using Laravel which is a full stack web application PHP framework and MYSQL as the database management system.

# Key Features
1. hello
2. ff

# Folder Structure

# Installation and Setup Guide

## Prerequisites
Before setting up the project be sure you have the following tools installed:
1. **PHP**
   - PHP version 8.0 or higher
2. **Composer**
   - Install composer from https://getcomposer.org/download/.
3. **Node.js**
   - Used for handling frontend dependencies
   - Install node.js from https://nodejs.org/en/download/prebuilt-installer .
5. **MySQL for database management**

## Steps to setup the project
1. **Clone the repository:**
   ```bash
   git clone https://github.com/SmritiGrg/FYP-FoodiesArchive.git
   ```
2. **Navigate to the project directory:**
    ```bash
    cd FYP-FoodiesArchive
   ```
3. **Install Composer Dependencies:**
   - this command ensures that the project has all the dependencies and libraries installed
    ```bash
    composer install
    ```
4. **Copy the .env.example file and rename it to .env :**
    ```bash
    cp .env.example .env
   ```
5. **Create Database:**
   - Start XAMPP and run  MySQL and Apache.
   - Open phpMyAdmin and create a database name "foodies_archive".
    
6. **Run migration to set up database tables:**
   ```bash
    php artisan migrate
   ```
7. **Generate Application Key:**
   ```bash
    php artisan key:generate
   ```
8. **Start or run the project:**
   ```bash
    php artisan serve
   ```
