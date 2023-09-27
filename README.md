## Install Source
- Step 1: Change file .env.example to .env 

- Step 2: Install Vendor Laravel
```bash
composer install
```

- Step 3: Create generate key
```bash
php artisan key:generate
```

- Step 4: Create DB and then check and update information to connect DB in .env

- Step 5: Run migrate
```bash
php artisan migrate
```

- Step 6: Clear cache server
```bash
php artisan config:cache
```

- Step 7: Run project
```bash
php artisan serve
```

- Step 8: Go link
```bash
http://localhost:8000/admin/category/index
```


