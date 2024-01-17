
### Setup
- Clone the repo
- Run `composer install`
- Run `cp .env.example .env`
- Run `php artisan key:generate`
- Fill out .env
- Run `php artisan migrate`
- Run `php artisan db:seed`

### API & Manual testing
The project utilizes Request-Docs package, after setup you can visit the `/request-docs` endpoint to perform manual tests, export OpenAPI and more. More information on [https://github.com/rakutentech/laravel-request-docs](https://github.com/rakutentech/laravel-request-docs)

#### Testing accounts - post seed
- ADMIN 
    - email: foo@bar.com
    - password: 12345678
- EDITOR
    - email: bar@foo.com
    - password: 12345678
    
#### Structure
The core business logic is located in `App\Core` directory, resembling feature-based structure.

#### Notes
- Default Laravel db columns are still `snake_case` due to built in auth behaviour, everything else, custom is `camelCase`.
- Updating a travel duration does not alter tour duration and name.
