How to Run the Final Project Web of Chillout Team
=================================================

GitHub Repository
-----------------

**URL:** [Final Advanced Project ChillOut](https://github.com/LeTiepTuyen/Final_Advanced_Project_ChillOut.git)

This project contains the backend (Laravel with PostgreSQL) and frontend (Nuxt 3) for the Final Advanced Project of the Chillout team.

## GitHub Repository

[Final Advanced Project ChillOut](https://github.com/LeTiepTuyen/Final_Advanced_Project_ChillOut.git)

---

## How to Run the Project

### Backend (Laravel + PostgreSQL)

1. **Clone the repository:**

   ```bash
   git clone https://github.com/LeTiepTuyen/Final_Advanced_Project_ChillOut.git
   cd ./backend


2. **Create a .env file from the example:**

   ```bash
   cp .env.example .env

3. **Install dependencies:**

   ```bash
   composer install

4. **Generate the APP_KEY:**

   ```bash
   php artisan key:generate

5. **Run migrations and seeders:**

   ```bash
   php artisan migrate --seed

6. **Start the Laravel server:**

   ```bash
   php artisan serve

### 2\. Running the Frontend (Nuxt 3)

1. **Navigate to the frontend directory:**

   ```bash
   cd ./frontend


2. **Install dependencies:**

   ```bash
   npm install

3. **Start the development server:**

   ```bash
   npm run dev
