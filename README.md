##### in progress

* validation

### Run app dev
1) указать DATABASE_URL в .env
2) выполнить:

    
    composer install
    
    bin/console doctrine:database:create
    bin/console doctrine:schema:create
    
    sh bin/generateJWT.sh
    
    php bin/console doctrine:fixtures:load // create admin (pass: admin)
    
    php -S 127.0.0.1:8000 -t public // run dev server
   
   http://127.0.0.1:8000/api/docs - docs
    