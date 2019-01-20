# nanfl
Not Actually the National Football League

# Local Environment Configuration
Instructions for first run. Docker is not required but it makes things a little easier.

## Requirements
- Docker

## Setup
- Clone repo with submodules.
- Make local_setup.sh executable
- run local_setup.sh
    - **Please Note:** Running local setup will forward the ~/.ssh directory to the Docker container.
- From Application Root:`$ cd laradock_nanfl && docker-compose up -d nginx postgres && cd ..`
    - **Please Note:** This may take some time to complete.
- at application root, copy .env.example and fill with appropriate values.
- `$touch database/database.sqlite` + testing
- Enter Container: `$ cd laradock_nanfl && docker-compose exec --user=laradock workspace bash`
- From Within Container,at application root:
 >`$composer install`
 >
 >`$php artisan key:generate` + generate --env=testing
 >
 >`$npm install`
 >`$php artisan migrate`
 >`$php artisan passport:install`
 
 - run seeder
 
 - create user token
 - add token to env
 - flush config
 
## Docker Commands
- To enter the container, from application root:
    -`$ cd laradock_nanfl && docker-compose exec --user=laradock workspace bash`

- To shutdown container, from application root:
    -`$ cd laradock_nanfl && docker-compose down`