# Board

This is a simple board application built with PHP.

---

## Requirements

Before you begin, ensure you have the following installed:

* **PHP** version 8.0 or higher
* **Composer**
* **MySQL**
* **XAMPP** (or a similar local server environment that includes Apache and MySQL)

---

## Installation

Follow these steps to get the project up and running on your local machine:

1.  **Clone the Repository:**
    Open your terminal or command prompt and run:
    ```bash
    git clone [https://github.com/Ap4chee/Board.git](https://github.com/Ap4chee/Board.git)
    cd Board
    ```

2.  **Install PHP Dependencies:**
    Navigate into the `Board` directory (if you're not already there) and install the required PHP packages:
    ```bash
    composer install
    ```

3.  **Set Up Your Database:**
    * Start **XAMPP** (Apache and MySQL).
    * Open your web browser and go to `http://localhost/phpmyadmin/`.
    * Create a **new database**. You can name it something like `myboard` (or any name you prefer).

4.  **Configure Environment Variables:**
    * Open the `.env` file and update the database configuration section to match your new database:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=myboard  <--- Replace 'myboard' with your database name if different
    DB_USERNAME=root     <--- Your MySQL username (usually 'root' for XAMPP)
    DB_PASSWORD=         <--- Your MySQL password (often empty for XAMPP)
    ```

5.  **Generate Application Key and Run Migrations:**
    From your project's root directory, run the following commands to generate an application key and set up your database tables:
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

6.  **Start the Development Server:**
    Finally, start the PHP development server:
    ```bash
    php artisan serve
    ```
    You will see output similar to this:
    `Server running on [http://127.0.0.1:8000].`

7.  **Access the Application:**
    Open your web browser and navigate to the address provided (e.g., `http://127.0.0.1:8000`).

You should now see the Board application running!
