# BasementBox
BasementBox is a sample digital video game store website made for a college course. It focuses on housing video games with the retro aesthetic. ***It is not being used commercially and was made as a student project only.***

## Status
This project is currently in-development.

## Features
The project features are listed below and are grouped based on the type of end-user. The features that are listed on a preceding section are additive to the succeeding sections. (For example, buyer accounts can write comments, then seller accounts can do that on other game pages too. However, buyer accounts cannot make game pages.)
### Casual User/Buyer
- Add to cart
- Browse games
- Upload comments/reviews
- Edit their own comments/reviews
- Report comments/reviews
- Report games
- Checkout
### Developer/Seller
- Publish game pages
- Edit game pages
- Mark comments/reviews as deleted
### Admin
- See registered accounts
- See reported games
- See reported comments
- Delete user accounts
- Delete comments/reviews
- Delete game pages

## Dependencies
- [Composer](https://getcomposer.org/) is used for other project dependencies.
- [XAMPP](https://www.apachefriends.org/) is used for Apache web server and the MySQL app it has. Make sure that PHP and MySQL are installed.

## Contributing
### Initial Installation and Setup
1. Clone this repo
2. Open a terminal window inside the repo folder
3. Run `composer install` to install other dependencies
4. Run `copy .env.example .env` to make a copy of the environment config file
5. Open the `.env` file in a text editor, make sure the `APP_NAME` key has a value of `BasementBox`
6. In the `.env` file, make sure the `DB_DATABASE` key has a value of `basementbox`
7. Run `php artisan key:generate` to generate the APP KEY
8. Run `php artisan migrate` to run the database migrations
9. Type 'y' and press enter when you're prompted to make the database
10. Run `php artisan db:seed` to seed the database
11. Run `php artisan serve` to initialize the development server:
12. Open http://localhost:8000 in your browser

### Learning Laravel
Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
