## **Setup**

1. `git clone`
2. `docker compose up -d`
4. `docker exec -i symfony_php_fpm_1 composer install`
5. `cp .env.dist .env.local`
7. `docker exec -i symfony_php_fpm_1 php bin/console doctrine:migrations:migrate`


## **Routes**
Name                          Method   Scheme   Host   Path    
app_create_hash               POST     ANY      ANY    /api/{version}/hashes
app_get_with_collision_hash   GET      ANY      ANY    /api/{version}/hashes/{hash}
