# Student Management System

A comprehensive web application for managing students and course sections at a university, built with PHP and MySQL.

## Project Overview

This Student Management System provides an intuitive interface for administrators to manage student records and course sections. The application follows the MVC (Model-View-Controller) architecture pattern for better code organization and maintainability.

### Features

- **User Authentication**: Secure login system for administrators
- **Student Management**: Add, view, update, and delete student records
- **Section Management**: Create and manage course sections
- **Export Functionality**: Export data to PDF and CSV formats
- **Responsive Design**: Bootstrap-based UI for desktop and mobile devices

## Directory Structure
project/
├── config/              # Configuration files
│   └── database.php     # Database connection settings
├── controllers/         # Controller classes
│   ├── AdminController.php
│   └── AuthController.php
├── includes/            # Reusable page elements
│   ├── footer.php
│   └── header.php
├── libs/                # External libraries
│   ├── fpdf/           # PDF generation library
│   ├── PHPExcel/       # Excel file handling
│   └── PhpSpreadsheet/ # Spreadsheet manipulation
├── models/              # Data models
│   ├── Section.php
│   ├── SectionRepository.php
│   ├── Student.php
│   ├── StudentRepository.php
│   ├── User.php
│   └── UserRepository.php
├── public/              # Publicly accessible files
│   ├── css/
│   ├── js/
│   └── images/
├── views/               # View templates
│   ├── admin/          # Admin panel views
│   └── auth/           # Authentication views
├── add_user.php         # User creation script
├── create_admin.php     # Admin creation script
├── index.php            # Entry point
└── isAuthentificated.php # Authentication check
Copier
## Installation


### Setup Instructions

1. **Clone the repository**
git clone https://github.com/yourusername/student-management-system.git
cd student-management-system
Copier
2. **Set up the database**
- Create a MySQL database named `university`
-  run the SQL script below to create the required tables

```sql
create database university;
use university;

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);


CREATE TABLE sections (
    id SERIAL PRIMARY KEY,
    designation VARCHAR(100) NOT NULL,
    description TEXT
);


CREATE TABLE students (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    image VARCHAR(255),
    section_id INTEGER REFERENCES sections(id) ON DELETE SET NULL
);
Configure the database connection

Update the database credentials in config/database.php with your MySQL details


Create an admin user

Navigate to http://yourserver/create_admin.php to create the first admin user
Or Run the PHP file create_admin after changing user data 




Usage

Access the application

Open your web browser and navigate to http://yourserver/
Log in using your admin credentials


Managing Sections

Navigate to the Sections module to view, add, edit, or delete course sections
Export section data to PDF or CSV formats


Managing Students

Navigate to the Students module to view, add, edit, or delete student records
Students can be assigned to specific sections
Student data can be exported to PDF or CSV formats



Authors

Yasser Chouket
Youssef Chkili

