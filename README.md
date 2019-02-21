# square

## Table of Contents
1. [Installation](#installation)
2. [Usage](#usage)

## Installation
Install Laravel on Ubuntu (mine was a Virtual Machine) following the steps from this tutorial:
https://www.howtoforge.com/tutorial/install-laravel-on-ubuntu-for-apache/

## Usage
First Step:
Create a mysql database, in this case I used:
Database name: cesar
User: cesar
Password: cesar

Second Step:
Clone this repo

Third Step:
Install all dependencies with composer:
composer install

Fourth Step:
Run following command so it populate database with data from original website:
php artisan scrap:products

This has been done with a command so we can run it every time we need it, or we can add it to a cron job or queue- This way we'll have controll and will not overload original website.

Fifth step
You can enter website and see all products, and also enter shared wishlists if you have the link.
You can register or login, if you want, by using navbar links.
If you are logged in, you can create yoour own wishlist by adding new products, or manage it from top navbar. You can also get your "share link" here.
