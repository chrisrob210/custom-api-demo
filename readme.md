
## Custom API
Adds API routing capabilities to PHP 5.3.9

### How it works
Think of each endpoint as an encapsulated service with its own controllers and routes. 
1. Place your service within the base directory like so: `./exampleservice`
2. Controllers for exampleservice go in `./exampleservice/controllers`
3. Create a routes file and place it within the service folder: `./exampleservice/routes.php`
4. Endpoints will work like this `www.yourdomain.com/exampleservice/some_route_endpoint`

for more see: [example service](https://github.com/chrisrob210/custom-api-demo/tree/main/example) and [blog service](https://github.com/chrisrob210/custom-api-demo/tree/main/blog)
