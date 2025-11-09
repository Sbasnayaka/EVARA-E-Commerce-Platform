# How to Run EVARA Application

## Prerequisites
- XAMPP installed on your Windows machine
- Web browser (Chrome, Firefox, Edge, etc.)

## Step-by-Step Instructions

### Step 1: Start XAMPP Services

1. **Open XAMPP Control Panel**
   - Press `Windows Key` and search for "XAMPP Control Panel"
   - Or navigate to: `C:\xampp\xampp-control.exe`

2. **Start Apache and MySQL**
   - Click the **"Start"** button next to **Apache**
   - Click the **"Start"** button next to **MySQL**
   - Both should show green "Running" status

   ⚠️ **Note**: If you see port conflicts (usually port 80 or 443 for Apache, or 3306 for MySQL), you may need to:
   - Stop other services using those ports
   - Or change the ports in XAMPP settings

### Step 2: Import the Database

1. **Open phpMyAdmin**
   - Open your web browser
   - Go to: `http://localhost/phpmyadmin`
   - Or click "Admin" button next to MySQL in XAMPP Control Panel

2. **Create/Import Database**
   - Click on **"New"** in the left sidebar
   - Database name: `evara_db`
   - Collation: `utf8mb4_general_ci`
   - Click **"Create"**

3. **Import SQL File**
   - Select the `evara_db` database from the left sidebar
   - Click on the **"Import"** tab at the top
   - Click **"Choose File"** button
   - Navigate to: `C:\xampp\htdocs\EVARA_SA23800946\Database\evara_db.sql`
   - Select the file and click **"Open"**
   - Scroll down and click **"Go"** button
   - Wait for the import to complete (you should see "Import has been successfully finished")

### Step 3: Access Your Application

1. **Open Your Web Browser**
   - Open Chrome, Firefox, Edge, or any browser

2. **Navigate to Your Application**
   - Type in the address bar: `http://localhost/EVARA_SA23800946/`
   - Or: `http://localhost/EVARA_SA23800946/index.php`

3. **You should see the EVARA homepage!**

## Testing the Application

### Test User Accounts (from database):
- **Customer Account:**
  - Username: `Sanuu`
  - Password: (check database for hashed password, or create new account)
  
- **Admin Account:**
  - Username: `Basnayaka`
  - Password: (check database for hashed password, or create new account)

### Create a New Account:
1. Click **"Account"** in the navigation
2. Click **"Sign Up"**
3. Fill in the form:
   - Select Role: Customer or Admin
   - Username
   - Email
   - Password (minimum 8 characters)
   - Confirm Password
4. Click **"Create Account"**

### Login:
1. Click **"Account"** in the navigation
2. Click **"Log In"**
3. Select your role
4. Enter username and password
5. Click **"Login"**

## Troubleshooting

### Problem: Apache won't start
**Solutions:**
- Check if port 80 is already in use
- Run XAMPP Control Panel as Administrator
- Check Windows Firewall settings

### Problem: MySQL won't start
**Solutions:**
- Check if port 3306 is already in use
- Run XAMPP Control Panel as Administrator
- Check if another MySQL service is running

### Problem: "Connection failed" error
**Solutions:**
- Make sure MySQL is running in XAMPP
- Verify database name is `evara_db`
- Check database credentials in PHP files (should be: username: `root`, password: `` (empty))

### Problem: Page shows "404 Not Found"
**Solutions:**
- Make sure your files are in: `C:\xampp\htdocs\EVARA_SA23800946\`
- Check the URL: `http://localhost/EVARA_SA23800946/index.php`
- Make sure Apache is running

### Problem: Database import fails
**Solutions:**
- Make sure you created the database first
- Check file path is correct
- Try importing in smaller chunks if the file is large

## Application Structure

```
EVARA_SA23800946/
├── index.php              (Homepage)
├── login.php              (Login page)
├── account.php            (Sign up page)
├── product.php            (Products page)
├── cart.php               (Shopping cart)
├── customize.php          (Customization page)
├── support.php            (Support/FAQ page)
├── user_dashboard.php     (User dashboard)
├── admin_dashboard.php    (Admin dashboard)
├── CSS/                   (Stylesheets)
├── JS/                    (JavaScript files)
├── pics/                  (Images)
└── Database/
    └── evara_db.sql       (Database file)
```

## Quick Start Commands

1. **Start XAMPP**: Open XAMPP Control Panel → Start Apache & MySQL
2. **Open Application**: `http://localhost/EVARA_SA23800946/`
3. **Open phpMyAdmin**: `http://localhost/phpmyadmin`

## Important Notes

- **Keep XAMPP running** while using the application
- **Database credentials** are set to default XAMPP settings:
  - Server: `localhost`
  - Username: `root`
  - Password: `` (empty)
  - Database: `evara_db`

- If you change MySQL password in XAMPP, update these files:
  - `login.php`
  - `login_process.php`
  - `account.php`
  - `cart.php`
  - `product.php`
  - `customize.php`
  - `support.php`
  - And all other PHP files with database connections

## Need Help?

If you encounter any issues:
1. Check XAMPP error logs: `C:\xampp\apache\logs\error.log`
2. Check MySQL error logs: `C:\xampp\mysql\data\mysql_error.log`
3. Make sure all PHP files are in the correct directory
4. Verify database import was successful

