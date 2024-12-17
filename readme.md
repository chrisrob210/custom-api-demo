## Custom API
Adds API routing capabilities to PHP 5.3.9

### How it works
Think of each endpoint as an encapsulated service with its own controllers and routes. 
1. Place your "service" within the base directory like so: `./exampleservice`
2. Controllers go in `controllers` folder: `./exampleservice/controllers`
		a. Ex: `./exampleservice/EpicController.php`
3. Create a `routes.php` file and place it within the service folder: `./exampleservice/routes.php`

see examples: `example` and `blog` 