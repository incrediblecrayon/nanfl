# NaNFL
Not a National Football League.  A simple `Laravel` API with a `Vue.js` front end. 

# Local Environment Configuration
Instructions for first run. Docker is not required but it makes things a little easier.

## Requirements
- Docker

## Setup
- Clone repo with submodules.
- Make local_setup.sh executable
- run local_setup.sh
    - **Please Note:** Running local setup will forward the ~/.ssh directory to the Docker container.
- From Application Root:`$ cd laradock_nanfl && docker-compose up -d nginx && cd ..`
    - **Please Note:** This may take some time to complete.
- at application root, copy .env.example and fill with appropriate values.
- at application root, create both sqlite databases.
    - `$touch database/database.sqlite`
    - `$touch database/testing_database.sqlite`
- Enter Container: 
    -`$cd laradock_nanfl && docker-compose exec --user=laradock workspace bash`
- From Within Container,at application root:
    - `$composer install`
    - `$php artisan key:generate`
    - `$npm install`
    - `$php artisan migrate`
    - `$php artisan passport:install`
    - `$php artisan db:seed`
    - Create User personal Access token in tinker:[Personal Access Token](https://laravel.com/docs/5.7/passport#personal-access-tokens)
    - flush config
 
## Docker Commands
- To enter the container, from application root:
    -`$ cd laradock_nanfl && docker-compose exec --user=laradock workspace bash`

- To shutdown container, from application root:
    -`$ cd laradock_nanfl && docker-compose down`
    
# deploy
- In container:
    - Set up SSH Agent from forwarded file: 
        -`$ eval $(ssh-agent) && ssh-add`
    - `vendor/bin/dep deploy production --branch=master -vvv`
    
    
# API Documentation
Some Basic API Documentation

## Team
### Show All Teams
- path: `/api/team`
- method: GET
- auth: public

### Show Team of ID with Players
- path: `/api/team/{ID}`
- method: GET
- auth: pubic

### Create Team
- path: `/api/team`
- method: POST
- auth: required
- params:
    - name(required) - String
    - city(required) - String
    - color_main(required) - Hex Color Value
    - color_accent(required) - Hex Color Value

### Delete Team
- path: '/api/team'
- method: DELETE
- auth: required

## Player
### Show All Player
- path: `/api/player`
- method: GET
- auth: public

### Show Player of ID
- path: `/api/player/{ID}`
- method: GET
- auth: pubic

### Create Player
- path: `/api/player`
- method: POST
- auth: required
- params:
    - first_name(required) - String
    - last_name(required) - String
    - team_id(required, must exist in teams) - int
    
### Update Player
- path: `/api/player/{ID}`
- method: PUT
- auth: required
- params:
    - first_name - String
    - last_name - String
    - team_id(must exist in teams table) - int

### Delete Player
- path: '/api/player'
- method: DELETE
- auth: required
