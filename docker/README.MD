## Базовые docker-образы для backoffice.contact.org.il

### Включает образы для:

#### Некоторые образы могут иметь вариант для разработки `(*-dev)`

- nginx
  - `registry.gitlab.com/contact-israel1/docker/nginx` 
- php-fpm
  - `registry.gitlab.com/contact-israel1/docker/php-fpm`
  - `registry.gitlab.com/contact-israel1/docker/php-fpm-dev`
- php-worker
  - `registry.gitlab.com/contact-israel1/docker/php-worker`
- mysql
  - `registry.gitlab.com/contact-israel1/docker/mysql`
  - `registry.gitlab.com/contact-israel1/docker/mysql-dev`
- redis
  - `registry.gitlab.com/contact-israel1/docker/redis`

### Все образы находятся в закрытом реестре образов. Для их использования нужно предварительно авторизоваться в реестре с помощью команды:

`docker login registry.gitlab.com -u USER_NAME -p TOKEN`

#### где:

- `USER_NAME` - логин
- `TOKEN` - специальный токен доступа
