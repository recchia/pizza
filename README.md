# Pizza
Pizza App example

In ordet to run  tha app you need follow the next steps:

#### Clone Repository

`git clone git@github.com:recchia/pizza.git`

#### Install & compile dependencies

`cd pizza`

`composer install --prefer-dist`

`yarn install`

`yarn dev`

#### Start environment

`docker-compose up -d`

#### Run migrations

`docker exec -ti pizza_php bin/console doctrine:migrations:migrate`

#### Create an admin user

`docker exec -ti pizza_php bin/console app:create-admin-user <email> <password>`

#### Browse the app

Go to http://localhost:8080