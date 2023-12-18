### Running instructions...

- make sure db (mysql), node, php and composer are installed  
- copy .env.develop to .env and edit credentials:  
  DB_CONNECTION=mysql  
  DB_HOST=127.0.0.1  
  DB_PORT=3306  
  DB_DATABASE=house_test  
  DB_USERNAME=root  
  DB_PASSWORD=  
- download libs:  
  composer install  
  npm install  
- run the initial migration:  
  php artisan migrate  
  (it may ask to create a database, answer yes)  
- run the seed command:  
  php artisan db:seed  
- start servers:  
  php artisan serve  
  npm run dev  
- open http://localhost:8000/  

Enjoy!
