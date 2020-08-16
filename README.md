#### Steps to set up the project
1 Spin up the containers
```
docker-compose up -d --build
```

2 Create a database
```
docker exec php74-container-genesis bash -c "bin/console doctrine:database:create"
```

3 Run migrations
```
docker exec php74-container-genesis bash -c "bin/console doctrine:migrations:migrate --no-interaction"
```

4 Load fixtures
```
docker exec php74-container-genesis bash -c "bin/console doctrine:fixtures:load --no-interaction"
```

#### Additional info

Front end is on [localhost:3009](http://localhost:3009).

Api is on [localhost:8089](http://localhost:8089).