#  PHP Test API

## How to Deploy
__1. Install Git__

Open your console and run this command
```console
  sudo apt-get install git
```

__2. Install Composer__
```console
  cd ~
  curl -sS https://getcomposer.org/installer -o composer-setup.php
  sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

__3. Clone this Repository__

__4. Copy .env File__
```console
  cp .env.example .env
```

__5. Install Composer Project__
```console
  composer install
```

__6. Run Migration__
```console
  php artisan migrate
  php artisan passport:install
```

__7. Run Laravel Server__
```console
  php artisan serve
```

__8. Launch API__
- Use POST `http://127.0.0.1:8000/api/register` to register new user
- Use POST `http://127.0.0.1:8000/api/login` to login
- Use GET `http://127.0.0.1:8000/api/details` to get details of current user
- Use GET `http://127.0.0.1:8000/api/details/{id}` to get details of user by id
- Use GET `http://127.0.0.1:8000/api/list` to list all user
- Use PATCH `http://127.0.0.1:8000/api/user/{id}` to update user by id
- Use DELETE `http://127.0.0.1:8000/api/user/{id}` to delete user by id

- See details here https://www.getpostman.com/collections/6ff411678c3dd196d860

## Thank You
