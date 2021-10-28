## Software Engineer Assessment
This application is built with the following technologies:
1. HTML
2. CSS,
3. Bootstrap(3.3.7)
4. Jquery(1.12.4)
4. SweetAlert
5. PHP(7.3.29) and Apache/2.4.48
6. Laravel Framework(7.18.0)
7. MYSQL(5.0.12)
8. Font-awesome(4.7.0)
9.Composer version 2.1.3 2021-06-09 16:31:20
10. XAMPP(7.3.29)


### This is how you can install this application
1. Clone this Repository(Repo) with the following command `git clone https://github.com/Bonifaceebuka/os-systems.git`
2. Move to the DIR of the Repo `cd os-systems.git`
3. Install composer with `composer install`
4. Save .env.example file as .env or run this command: `cp .env.example .env`
5.	Open the .env file and set the Database configurations as follows:<br>
	DB_CONNECTION=mysql<br>
	DB_HOST=127.0.0.1<br>
	DB_PORT=3306<br>
	DB_DATABASE=YOUR_DATABASE_NAME<br>
	DB_USERNAME=YOUR_SERVER_USERNAME<br>
	DB_PASSWORD=YOUR_DATABASE_PASSWORD (Leave it empty if you have none)<br>
6. Generate new Key with this command: `php artisan key:generate`
7. Import the database tables with this command: `php artisan migrate` or use the `os-system.sql file` in 'db' folder of this project
8. Run the Seeder to insert demo into the database whcih you can use for testing the application. Run the seeder with the following artisan command<br>
    `php artisan db:seed`
9.  Run `php artisan storage:link` to ensure that you don't have issues with file upload to your storage folder.
10. Start the application with `php artisan serve`
	Visit localhost:8000/ to see the front-end of the application
