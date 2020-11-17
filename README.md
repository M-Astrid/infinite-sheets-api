##### in progress

* настроить базовые конфиги api platform
* создать сущности юзеров и описать авторизацию (JWT)

### Run app dev

    composer install
    bin/console doctrine:database:create
    bin/console doctrine:schema:create
    
    php -S 127.0.0.1:8000 -t public
   
   http://127.0.0.1:8000/api - docs
    