# ITE311-LAYAN CodeIgniter Project Setup Guide

## Project Overview
This is your CodeIgniter 4 project for ITE311 with user authentication and role-based access control.

## ✅ COMPLETED TASKS

### Step 1: Project Setup ✅ COMPLETED
- **Database Configuration**: ✅ Complete
  - Database `lms_layan` configured and connected
  - Users table exists with proper structure
- **Migration**: ✅ Complete
  - Migration file `2025-09-27-030000_UpdateUserRoleColumn.php` created
  - Role column updated with correct ENUM values (admin, teacher, student)
- **Session Storage**: ✅ Complete
  - Session directory writable and configured
  - Verification script `test_session_write.php` working

### Step 2: Unified Dashboard ✅ COMPLETED
- **Login Process**: ✅ Complete
  - Unified login for all roles (admin, teacher, student)
  - Role correctly stored in session data
  - Redirect to single dashboard endpoint
- **Role-based Dashboard**: ✅ Complete
  - Single dashboard method handles all roles
  - Conditional content based on user role
  - Admin, Teacher, Student features implemented
- **Dashboard View**: ✅ Complete
  - Modern glassmorphism UI design
  - Role-specific statistics and actions
  - Bootstrap 5 integration

## Current Status ✅

### Database Configuration
- **Database Name**: `lms_layan`
- **Host**: `localhost`
- **Username**: `root`
- **Password**: (empty)

### Users Table Structure
The `users` table already exists with the following structure:
- `id` (INT, primary key, auto-increment)
- `name` (VARCHAR, 100)
- `email` (VARCHAR, 100, unique)
- `password` (VARCHAR, 255)
- `role` (ENUM: 'admin', 'teacher', 'student')
- `created_at` (DATETIME)
- `updated_at` (DATETIME)

### Authentication System
- ✅ Login process correctly stores user role in session data
- ✅ Session includes: `userID`, `name`, `email`, `role`, `isLoggedIn`
- ✅ Auth controller handles registration, login, logout, and dashboard

## Setup Instructions

### Step 1: Ensure Local Server is Running
1. Start XAMPP control panel
2. Start Apache server
3. Start MySQL database

### Step 2: Run Database Migration
Open terminal in project root and run:
```bash
php spark migrate
```

This will:
- Create the database if it doesn't exist
- Run all migrations including the new role column update

### Step 3: Verify Setup
Run the verification script:
```bash
php verify_setup.php
```

This will check:
- Database connection
- Users table existence
- Role column structure
- Existing user counts

### Step 4: Test the Application
1. Open your browser and navigate to: `http://localhost/ITE311-LAYAN/`
2. Test registration at: `http://localhost/ITE311-LAYAN/register`
3. Test login at: `http://localhost/ITE311-LAYAN/login`

## Default Admin Account
The system includes a default admin user:
- **Email**: `admin@layan.com`
- **Password**: `admin123`
- **Role**: `admin`

## Role-Based Access
The system supports three user roles:
1. **admin** - Full system access
2. **teacher** - Course management and grading
3. **student** - Course enrollment and submission

## Session Data Structure
Upon successful login, the following session data is stored:
```php
[
    'userID' => user_id,
    'name' => user_name,
    'email' => user_email,
    'role' => user_role,  // 'admin', 'teacher', or 'student'
    'isLoggedIn' => true
]
```

## Files Modified/Created
1. **Migration**: `app/Database/Migrations/2025-09-27-030000_UpdateUserRoleColumn.php`
   - Updates role column from 'instructor' to 'teacher'

2. **Verification Script**: `verify_setup.php`
   - Tests database connection and table structure

3. **Setup Guide**: `SETUP_GUIDE.md`
   - This documentation file

## Next Steps
Your project is now ready for Lab 4 implementation. The authentication system is properly configured with role-based session management.
