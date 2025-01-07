# Chill out: The Super Luxury Funiture Online Shop

## Overview

Welcome to Chill out, your destination for premium, high-end furniture. We offer a curated selection of luxurious pieces designed to enhance the elegance and comfort of your home. Enjoy a seamless shopping experience with our exquisite collection.

### GitHub Repository
-----------------

**URL:** [Final Advanced Project ChillOut](https://github.com/LeTiepTuyen/Final_Advanced_Project_ChillOut.git)

This project contains the backend (Laravel with PostgreSQL) and frontend (Nuxt 3) for the Final Advanced Project of the Chillout team.

## Technologies

### Backend
- **Laravel**: A robust PHP framework for building scalable, secure, and high-performance web applications, offering tools for routing, database migrations, and templating.
- **Eloquent ORM**: Laravel's built-in Object-Relational Mapping (ORM) that provides an elegant and intuitive way to interact with the database, supporting relationships, query building, and model management.
- **Sanctum**: A Laravel package for managing API authentication and single-page application (SPA) tokens with simplicity and security.
- **Pulse**: A Laravel tool for monitoring application health and performance, providing insights into metrics, errors, and system statuses.
- **Scout**: A Laravel package for adding full-text search functionality to models, supporting integration with search engines like Algolia or Elasticsearch.
- **Sentry**: A real-time error tracking and monitoring tool that helps developers identify and fix issues in applications, integrated seamlessly with Laravel.
- **Scramble**: A Laravel utility for generating API documentation dynamically, helping developers create clear and structured documentation directly from their codebase.
- **Meilisearch**: A fast and modern search engine that integrates easily with Laravel through Scout, providing features like typo tolerance, relevance ranking, and instant search capabilities.
- **Telescope**: A debugging and monitoring tool for Laravel applications, providing insights into requests, jobs, exceptions, logs, and more, tailored for developers to enhance productivity.
- **Slack Webhook**: A Laravel feature for sending notifications and alerts to Slack channels, enabling real-time communication about application events, errors, or system updates.
- **Laravel Dusk**: A browser automation testing tool for simulating user interactions and performing end-to-end tests in a Laravel application.
- **Laravel Sail**:A lightweight command-line interface for interacting with Docker, providing a simple way to set up and manage a development environment for Laravel applications using Docker containers.
### Frontend
- **Nuxt.js**: A framework for building server-side rendered Vue.js applications.
- **Vue.js**: The progressive JavaScript framework for building user interfaces.
- **Pinia**: A state management library for Vue.
- **Tailwind CSS**: A utility-first CSS framework for rapid UI development.
- **PrimeVue**: A rich set of UI components for Vue.
- **Material Design Icons**: A collection of free-to-use, community-driven icons.
- **SweetAlert2**: A beautiful, responsive, customizable, and accessible replacement for JavaScript's popup boxes.
- **Lodash**: A modern JavaScript utility library delivering modularity, performance, and extras.
- **Axios**: A JavaScript library for making HTTP requests, offering a simple API with support for Promises, JSON data handling, request cancellation, and easy configuration.
## Detail of the project

- [Wireframe](./WireFrame/Readme.md)
- [Planning](./Planning/README.md)
- [ERD Diagram](./Database_Description/DATABASE_DESCRIPTION.md)
- [ScreenShot](./Screenshot/README.md)
- [Video](./Video/ReviewVideo.mp4)

## Prerequisites

Before running this project, ensure you have the following installed:

- [Node.js](https://nodejs.org/en/download/)
- [Vue.js](https://vi.vuejs.org/v2/guide/installation)
- [Git](https://git-scm.com/downloads)
- [PHP](https://www.php.net/distributions/php-8.4.2.tar.gz)
- [PgAdmin 4](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads)
- [Docker](https://docker.com)

## Project Flow


## Setup Instructions

### Backend (Laravel + PostgreSQL)
   We use Laravel Sail to Dockerize the entire Laravel backend, which isolates the development environment, independent of the local machine's environment. It integrates and communicates with other services (PgSQL, Redis, Meilisearch, etc.) through the Docker network, providing a standardized development environment for the entire backend.
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

6. **Start the Meilisearch by docker:**
   If you don'd have docker, please download on this [link](https://docker.com) and open it.

   ```bash
   docker-compose up -d

7. **Run laravel queue:**
   ```bash
   php artisan queue:work

8. **Import data to Meilisearch:**

   ```bash
   php artisan scout:import 'App\Models\Product'

9.  **Start the Laravel server:**

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



Note: Resetting the database is generally not required unless specifically needed for development purposes.

## Contributors

1. LeTiepTuyen - Tuyen Tiep Le - [Email](mailto:tuyentieple@gmail.com)
2. hongngoc2449 - Ngoc Hong Doan - [Email](mailto:hongngoc2449@gmail.com)
3. LeTuyen2002 - Tuyen Trung Le - [Email](mailto:letrungtuyen2002@gmail.com)
4. WilliamSimon13 - Tin Thieu Mai - [Email](mailto:maithieutin@gmail.com)
