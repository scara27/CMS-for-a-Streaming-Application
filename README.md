# CMS-for-Streaming-Application

A web-based **CMS** for managing streaming content (movies, TV shows, live streams) with data fetched from IMDb via **OMDb API**. Built with **Laravel**.

## Features
- Add, edit, delete movies, TV shows, live content  
- Automatic content details from **OMDb API**  
- Authentication for admin access  
- Live content flags: adult/kids, catch-up  
- Database managed with **Laravel migrations**  
- Blade templates + Tailwind CSS

## Technologies
PHP, Laravel, MySQL, Blade, Tailwind CSS, OMDb API

## Getting Started
1. Clone the repo:  
   `git clone <repository-url>`  
2. Install dependencies:  
   `composer install`  
3. Configure `.env` with database credentials and `OMDB_API_KEY`  
4. Run migrations:  
   `php artisan migrate`  
5. Start the server:  
   `php artisan serve`  
6. Visit [http://localhost:8000](http://localhost:8000)
