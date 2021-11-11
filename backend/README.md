# Application

## インストール

```
cd backend
docker-compose up -d

docker-compose exec app bin/cake migrations migrate
docker-compose exec app php composer.phar test

docker-compose down
```


## マイグレーション

```
docker-compose exec app bin/cake bake migration CreateTasks
docker-compose exec app bin/cake migrations migrate
docker-compose exec app bin/cake bake model Tasks
```
