# Read Before Start – Billplz Payment Gateway Integration

Dear Encik Afiq,

Thank you for taking the time to review my technical assessment submission. This document provides a quick step-by-step guide to set up and run the project on your local machine.

---

## 1. Prerequisites
- **PHP** 8.2 or higher
- **Composer**
- **MySQL**

---

## 2. How to Run the Project

### Step 1: Install Dependencies
Since the `vendor` directory is excluded to keep the archive size lightweight, please open your terminal in the project root directory and run:

```bash
composer install
```

### Step 2: Configure Environment File (`.env`)
The `.env` file is already included with the **Billplz Sandbox V3** credentials pre-configured. Please update the MySQL database connection settings in `.env` to match your local MySQL environment (e.g., port `3306` if using default MySQL/Laragon/XAMPP):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=interview-task
DB_USERNAME=root
DB_PASSWORD=
```

*(If `APP_KEY` is ever needed, you can also run `php artisan key:generate`).*

### Step 3: Set Up the Database (`BillplzPayment` Table)
Create a MySQL database named `interview-task` (or your preferred database name matching `DB_DATABASE` in `.env`), then choose **one** of the following options:

- **Option A – Import the Provided SQL File (Includes Sample Data):**  
  Import the included **`BillplzPayment.sql`** file located in the project root into your MySQL database. This will create the `BillplzPayment` table along with sample payment records.

- **Option B – Run Laravel Migrations (Fresh Table):**  
  Run the migration command in your terminal:
  ```bash
  php artisan migrate
  ```

### Step 4: Start the Application
Run the built-in Laravel development server:

```bash
php artisan serve
```

Then open your browser and visit:
```text
http://127.0.0.1:8000
```
*(Note: No `npm install` or `npm run build` is required, as the Figma design is built with pure HTML and CSS served directly from `resources/`).*

---

## 3. Project Structure Overview

| Requirement | File Location |
| :--- | :--- |
| **1. Figma Design (Pure HTML & CSS)** | `resources/views/welcome.blade.php`<br>`resources/css/app.css` |
| **2. Input Validation & Security** | `app/Http/Requests/StorePaymentRequest.php` |
| **3. Billplz V3 API Integration** | `app/Services/BillplzService.php`<br>`app/Http/Controllers/BillplzPaymentController.php`<br>`config/services.php` |
| **4. Database Table (`BillplzPayment`)** | `app/Models/BillplzPayment.php`<br>`database/migrations/2026_10_15_082239_create_billplz_payments_table.php`<br>`BillplzPayment.sql` |

---

Thank you again for your time and consideration. Please feel free to reach out if you have any questions.

Best regards,  
**Muizzuddin**

