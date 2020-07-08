<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installation Instructions

1. Run `git clone https://github.com/victorseraphin/backend-challenge.git backend-challenge`
2. Run `docker-compose up -d`
3. Run `docker-compose exec app bash`
### Dentro do Container 
4. From the projects root run `cp .env.example .env`
5. Run `composer install` from the projects root folder
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. From the projects root folder run `composer dump-autoload`
9. From the projects root folder run `php artisan db:seed`
10. From the projects root folder run `php artisan jwt:secret`
11. From the projects root folder run `php artisan serve`

### Dados Login

- route: `http://localhost/api/auth/login`  
- type:POST
```
{
    "email": "super@email.com",
    "password": "123456"
}
```

- resposta:
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTA3Nzc2NDYsImV4cCI6MTU5MDc4MTI0NiwibmJmIjoxNTkwNzc3NjQ2LCJqdGkiOiJmSUZpYUM0NWw0d29XMVZ5Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.adfUF1MvJ5NrJculPFU2MMaLjRwJA7c8H7blk1WyaZQ",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### Todas as demais rotas deve-se passar o header X preenchido com o access_token 
- route: `http://localhost/api/auth/logout`
- type:POST
### Rotas dos usuários 
- route: `http://localhost/api/users`
- type:GET
- route: `http://localhost/api/users/{id do usuário}`
- type:GET
- route: `http://localhost/api/users/salvar`
- type:POST
- route: `http://localhost/api/users/atualizar/{id do usuário}`
- type:POST
- route: `http://localhost/api/users/deletar/{id do usuário}`
- type:GET
```
{    
    "name": "Admin User",
    "email": "admin@email.com",
    "password": "123456",
    "confirma_senha": "123456"
}
```
### Rotas dos produtos 
- route: `http://localhost/api/produtos`
- type:GET
- route: `http://localhost/api/produtos/{id do produto}`
- type:GET
- route: `http://localhost/api/produtos/salvar`
- type:POST
- route: `http://localhost/api/produtos/atualizar/{id do produto}`
- type:POST
- route: `http://localhost/api/produtos/deletar/{id do produto}`
- type:GET
```
{    
    "name": "Play Station 4",
    "description": "Play Station 4",
    "price": 3000.00,
    "category": "MLB11172",
    "type": "P"
}
```
### Rotas das estruturas dos produtos 
- route: `http://localhost/api/estrutura_produtos`
- type:GET
- route: `http://localhost/api/estrutura_produtos/{id do kit do produto}`
- type:GET
- route: `http://localhost/api/estrutura_produtos/salvar`
- type:POST
- route: `http://localhost/api/estrutura_produtos/atualizar/{id do item do kit}`
- type:POST
- route: `http://localhost/api/estrutura_produtos/deletar/{id do item do kit}`
- type:GET
```
{    
    "kit_id": 4,
    "produtos_id": 1,
    "description": "Play Station 4",
    "qty": 1,
    "custo": 3000
}
```
### Rotas para pegar as categorias do Mercado Livre
- route: `http://localhost/api/categorias`
- type:GET
- route: `http://localhost/api/categorias/{id da categoria}`
- type:GET

