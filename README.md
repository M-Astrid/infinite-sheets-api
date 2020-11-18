##### in progress

* настроить базовые конфиги api platform
* создать сущности юзеров и описать авторизацию (JWT)

### Run app dev
 В .env:
1) указать DATABASE_URL в .env
    
    composer install
    
    bin/console doctrine:database:create
    bin/console doctrine:schema:create

    sh bin/generateJWT.sh
    
    php -S 127.0.0.1:8000 -t public
   
   http://127.0.0.1:8000/api/docs - docs
    