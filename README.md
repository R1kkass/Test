sudo docker-compose up -d

sudo docker-compose exec php composer install
sudo cp -i  docker/schedulefile/Schedule.php code/vendor/laravel/framework/src/Illuminate/Support/Facades
sudo docker-compose exec php composer install

скопировать .env.example в .env

sudo docker-compose exec php php artisan migrate

cd code
npm i
npm run build

seeder:
sudo docker-compose exec php php artisan db:seed UserSeeder
sudo docker-compose exec php php artisan db:seed TaskSeeder

Если не работает schedule - перезапустить конейнер supervisor