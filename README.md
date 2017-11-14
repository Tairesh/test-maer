INSTALLATION AND RUNNING
------------------------
```
git clone git@github.com:Tairesh/test-maer.git
cd test-maer
composer install
yes yes | ./yii migrate
./yii serve
```

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=test-maer',
    'username' => 'postgres',
    'password' => 'postgres',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.

