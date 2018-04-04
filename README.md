![Github All Releases](https://img.shields.io/github/downloads/WilliamNovak/mm-test/total.svg)
[![GitHub tag](https://img.shields.io/github/tag/WilliamNovak/mm-test.svg)](https://github.com/WilliamNovak/mm-test)
![GitHub release](https://img.shields.io/github/release/WilliamNovak/mm-test.svg)

![GitHub watchers](https://img.shields.io/github/watchers/WilliamNovak/mm-test.svg?style=social&label=Watch) ![GitHub stars](https://img.shields.io/github/stars/WilliamNovak/mm-test.svg?style=social&label=Stars)
[![GitHub forks](https://img.shields.io/github/forks/WilliamNovak/mm-test.svg?style=social&label=Fork)](https://github.com/WilliamNovak/mm-test)


# Madeira Madeira Test Package

Test of knowledge in programming for the company Madeira Madeira.

Access [**API GUIDE**](https://documenter.getpostman.com/view/538667/mm/RVu2mqJi) to view all endpoints of application.

**`CLIENT SIDE IN DEVELOPMENT`**.

### Features

- API written in PHP without using a framework.
- PDO (PHP Data Objects) for data abstraction.
- Conceptually created on top of the Laravel Framework in order to maintain and follow the pattern of development on top of a large scale commercial framework.
- Use NGINX server.

### Run

```
cd /var/www
git clone https://github.com/WilliamNovak/mm-test mm
```
**Create virtual host:**
```
sudo vi /etc/hosts
```
Add the following data:
```
127.0.0.1      madeira.williamnvk.server
127.0.0.1      madeira.williamnvk.client
```
Create a file `madeira.williamnvk.dev.conf` and put the following content on `/etc/nginx/sites-available/`.
```
server {
    listen       80;
    server_name  madeira.williamnvk.server;
    root         /var/www/mm/server;
    index        index.php;

    location ~ \.php$ {
        try_files      $uri /index.html index.php;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server {
    listen       80;
    server_name  madeira.williamnvk.client;
    root         /var/www/mm/client/build;

    location / {
        try_files $uri /index.html;
        add_header   Cache-Control public;
        expires      1d;
    }
}

```
And run this command and restart NGINX.
```
sudo ln -s /etc/nginx/sites-available/madeira.williamnvk.dev.conf /etc/nginx/sites-enabled/
```

**Create database**
```
mysql -u${USER} -p source /var/www/mm/server/database/dumps/schema.sql
* enter your password*
exit;
```

Rename `.env.example` to `.env` and edit this file on `/var/www/mm/server/` with configuration of your database server.

### Screens

![Contact list](https://raw.githubusercontent.com/WilliamNovak/mm-test/master/docs/screens/contact-list-v2.png)
![Sign in](https://raw.githubusercontent.com/WilliamNovak/mm-test/master/docs/screens/sign-in.png) ![Sign up](https://raw.githubusercontent.com/WilliamNovak/mm-test/master/docs/screens/sign-up.png)

### Extra

Import file `docs/postman_collection_v2.json` on `POSTMAN` to see all routes and the API requisitions without front end.

### The last release

- [x] Write in pure PHP
- [x] PHP >= 7.0
- [x] Custom ORM
- [x] PDO
- [x] MVC architecture
- [x] REST architecture
- [x] Composer autoload classes

### Coming on next release

- [ ] Possibility to use another Databases, like: Sqlite, MongoDB
- [ ] Image in docker
- [ ] PHPUnit tests
- [ ] Wiki
