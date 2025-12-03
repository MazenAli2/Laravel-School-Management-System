# Laravel School Management System (SMS)

A full-stack, comprehensive School Management System built with **Laravel** and **Blade/Livewire** (or **Blade/Bootstrap**). This system is designed to manage core administrative and academic workflows for educational institutions, supporting four distinct user roles.

## 🚀 Key Features

This system provides a full set of functionalities necessary for daily school operations:

### 👤 User Roles & Authentication

* **Admin:** Full control over the system, including user and curriculum management.
* **Teacher:** Manages students, records attendance, and inputs grades for assigned subjects.
* **Student:** Views personal schedule, attendance history, and grades.
* **Parent/Guardian:** Monitors children's grades, attendance, and receives absence notifications.

### 📚 Core Academic Modules

* **Curriculum Management (Admin):** CRUD operations for Grades, Sections, and Subjects.
* **Teacher Assignment (Admin):** Linking Teachers to specific Sections and Subjects.
* **Timetable System (Admin, Teacher, Student):** Full system for creating, viewing, and managing class schedules organized by day and time.
* **My Subjects / My Students (Teacher):** Dedicated views showing assigned courses and students.

### ✅ Operational Modules

* **Attendance Management:** Teacher records daily attendance (Present/Absent/Late). Students and Admins view historical reports.
* **Grading System:** Teacher inputs scores for subjects. Grades are displayed to Students and Parents with color-coded alerts.
* **Parent Notifications:** Real-time database notifications are triggered and displayed to parents when a child is marked **Absent**.

## 🛠️ Installation and Setup

Follow these steps to get your local environment running:

### Prerequisites

* PHP >= 8.1
* Composer
* Node.js & npm
* MySQL or other supported database

### Steps

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/MazenAli2/Laravel-School-Management-System.git](https://github.com/MazenAli2/Laravel-School-Management-System.git)
    cd Laravel-School-Management-System
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript Dependencies & Build Assets:**
    ```bash
    npm install
    npm run build
    ```

4.  **Environment Configuration:**
    * Duplicate the example environment file:
        ```bash
        cp .env.example .env
        ```
    * Generate a new application key:
        ```bash
        php artisan key:generate
        ```
    * Update your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) in the `.env` file.

5.  **Run Migrations and Seeders:**
    * Run the database migrations to create all necessary tables:
        ```bash
        php artisan migrate
        ```
    * (Optional) If you have a Seeder for initial data (Admin user, dummy students, etc.), run it:
        ```bash
        php artisan db:seed
        ```

6.  **Start the Server:**
    ```bash
    php artisan serve
    ```

## 🔑 Default Login Credentials

Use these credentials to test the system after running the initial seeder:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@school.com` | `password` |
| **Teacher** | `teacher@school.com` | `password` |
| **Student** | `student@school.com` | `password` |
| **Parent** | `parent@school.com` | `password` |

*(Note: These default emails assume you have corresponding users created in your database seeding.)*

## 🤝 Contribution

If you plan to continue developing this project, feel free to fork the repository.