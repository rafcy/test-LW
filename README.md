# **Project Setup Guide**

This guide provides step-by-step instructions to set up and run the project on **MacOS** and **Windows**.

---

## **📌 Prerequisites**
Before starting, ensure you have the following installed:

✅ **MongoDB** ([Download & Install](https://www.mongodb.com/try/download/community))  
✅ **Composer** ([Download & Install](https://getcomposer.org/))  
✅ **Node.js & NPM** ([Download & Install](https://nodejs.org/))  
✅ **PHP 8+** ([Download & Install](https://www.php.net/downloads.php))  
✅ **Laravel Valet (MacOS only)** ([Installation Guide](https://laravel.com/docs/valet))  

---

## **📌 Installation Steps**

### **🔹 1. Clone the Repository**
```bash
git clone https://github.com/rafcy/test-LW.git
cd your-repository
```

### **🔹 2. Install Dependencies**
Run the following command to install PHP and NPM dependencies:

```bash
composer install
npm ci
```

### **🔹 3. Create `.env` File**
Copy the `.env.example` file and update it:

```bash
cp .env.example .env
```

Modify the Mailchimp and/or MongoDB database variables to yours.

### **🔹 4. Generate Application Key**
```bash
php artisan key:generate
```

### **🔹 5. Set Up MongoDB**
Make sure MongoDB is running before proceeding.  

For **MacOS**, you can start MongoDB using:
```bash
brew services start mongodb-community
```
For **Windows**, open **MongoDB Compass** or run:
```powershell
mongod --dbpath="C:\data\db"
```

---

## **📌 Database Setup**

### **🔹 6. Run Migrations**
```bash
php artisan migrate
```

---

## **📌 Running the Application**

### **🔹 Option 1: Using Laravel Valet (MacOS)**
```bash
valet link project-name
valet secure
```
Visit: `https://project-name.test`

### **🔹 Option 2: Using PHP Built-in Server**
```bash
php artisan serve
```
Visit: `http://127.0.0.1:8000`

### **🔹 7. Start Vite for Frontend Development**
```bash
npm run dev
```
---

## **📌 Application Demo **

If you would like to watch the functionalities of the website, please watch the following demo.

[✅ **Video Demo** ](https://drive.google.com/file/d/1lm2AdUtezjTtilW4pmHcXrkWbHQQXGg8/view?usp=sharing)


## **📌 Additional Commands**

### **🔹 Running Tests**
To run **PHPUnit tests**:
```bash
php artisan test
```
