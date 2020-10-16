# Kaltura Media List

A small application that allows to login to a Kaltura account, to see/delete media items in a paginated table. The application also allows to search for items, to order items by "Created At" column and provides responsive UI.

## Frameworks and libraries used

* Laravel 7
* Kaltura API client library
* Bootstrap

## To install

    git clone https://github.com/michaelstepanov/kaltura-media-list.git
    cd kaltura-media-list
    Rename ".env.example" file into ".env"
    composer install
	
## To run

	php artisan serve

## Screenshots

List page
![List page](public/screenshots/list.png?raw=true "List page")

Login page
![Login page](public/screenshots/login.png?raw=true "Login page")
