# Welcome to Vaccine System

> [!IMPORTANT]  
> Please use docker to run this application.

### Clone Project
```git clone https://github.com/tamim-ikbal/vaccine-system.git```

### Install Composer
`composer install`
> [!IMPORTANT]  
> Please make sure you have PHP 8.2 and up to at-least run the composer install first time to install sail..

### Copy .env.example to .env
`cp .env.example .env`
> [!IMPORTANT]  
> Please configure the env.

### Generate Application Key
`php artisan key:generate`

### Build The Docker Container With Laravel Sail
`sail up` or `sail up -d` for detached mode

### Migrate the Database and Seed The Database
`sail artisan migrate:fresh --seed`
> [!IMPORTANT]  
> Essential Data are currently in seeder if you want to seed registration and other staff add them to DatabaseSeeder.php respectively.
> 

