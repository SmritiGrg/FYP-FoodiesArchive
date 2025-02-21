# FYP-FoodiesArchive

## Table Of Contents

- [About The Project](#about-the-project)
- [Key Features](#key-features)
- [Folder Structure](#folder-structure)
- [Installation and Setup Guide](#installation-and-setup-guide)

# About the Project
Foodie's Archive (Website) which is a comprehensive food website(like content creating of foods) built using PHP and laravel as its framework, a platform showcasing Nepal’s diverse foods, drinks, eateries, restaurants, etc. with their reviews, location, and likes. For this project I will be using Laravel which is a full stack web application PHP framework and MYSQL as the database management system.

# Key Features
1. **User Management:**
   - allows users signup, signin and delete account.
   - allows users to have username and password.
   - allows users to edit their profile.
   - allows user to see their history of their likes and comments. 
2. **Content Features:**
   - Information about various places of Nepal, giving descriptions, ratings and locations.
3. **Interaction Features:**
   - allows user to join foodie community where all the posts by the users are posted.
   - allows users to like, comment, ask questions, bookmark and share their favourite foods.
   - allows users to post their favourite food's photos, location, total rating, comment and like.
   - users can earn main points for uploading post, giving reviews and a certain number of badges for achievements.
   - addition to regular features it allows subscribers to get premium badges which can and recognition, encouraging user engagement and more subscriptions.
5. **Location and Map Integration:**
   - A user-friendly map that displays food places and helps users find nearby food options.
6. **Payment Feature:**
   - Payment feature for those users who wants to access premium features.
7. **Notification Features:**
   - users get notification if their are any new updates on new foods and replies on their reviews.
8. **Admin Panel:**
   - Admin will be able to maintain and update all the operations like contents, payments, etc.

# Folder Structure
In short about the main folders:
- `database/README` contains the business rules and entity relationship diagram.
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
5. **For Frontend packages:**
   ```bash
   npm install
   npm run build
   ```
    
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
