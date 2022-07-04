# OLS Laravel

This testing project from PT. Olsera Pratama Indonesia at [Olsera.com](https://olsera.com)

## Table of Contents

- [OLS Laravel](#ols-laravel)
  - [Table of Contents](#table-of-contents)
  - [Project Dependencies](#project-dependencies)
  - [Setup project](#setup-project)
  - [List of API Routes](#list-of-api-routes)
    - [Pajak](#pajak)
    - [Item](#item)
  - [About me](#about-me)
  - [License](#license)

## Project Dependencies

1. PHP min 7.4 for laravel 9.x
2. MySQL
3. Composer
4. PhpMyAdmin (optional)

## Setup project

1. Clone the repository
2. Create database with name `ols-laravel` via mysql CLI or phpmyadmin
3. run `composer install` to install composer dependencies
4. run `php artisan migrate:fresh --seed` to execute migration and seed
5. run `php artisan serve` to run laravel server

## List of API Routes

### Pajak

- Get Pajak

method: `GET`
url: `/pajak`
params: `none`
response:

```json
{
    "data": [
        {
            "id": 1,
            "nama": "pph",
            "rate": 0.05,
            "created_at": "2022-07-04T12:15:58.000000Z",
            "updated_at": "2022-07-04T12:15:58.000000Z"
        },
    ]
}
```

- Create Pajak

    method: `POST`
    url: `/pajak`
    body:

    ```json
    {
        "nama": "Pajak" (required),
        "rate": 0.05 (required | numerics)
    }
    ```

    response:

    ```json
    {
        "data": {
            "nama": "Pajak E",
            "rate": "0.01",
            "updated_at": "2022-07-04T14:31:10.000000Z",
            "created_at": "2022-07-04T14:31:10.000000Z",
            "id": 5
        }
    }
    ```

- Detail Pajak

    method: `GET`
    url: `/pajak/{id}`
    params: `id:integer`
    response:

    ```json
    {
        "data": {
            "id": 3,
            "nama": "Pajak C",
            "rate": 0.03,
            "created_at": "2022-07-04T12:48:15.000000Z",
            "updated_at": "2022-07-04T12:48:15.000000Z"
        }

    }
    ```

- Update Pajak

    method: `PUT`
    url: `/pajak/{id}`
    params: `id:integer`
    body:

    ```json
    {
        "nama": "Pajak", (required)
        "rate": 0.05 (required | numerics)
    }
    ```

    response:

    ```json
    {
        "data": {
            "id": 5,
            "nama": "Pajak D",
            "rate": "0.02",
            "created_at": "2022-07-04T14:31:10.000000Z",
            "updated_at": "2022-07-04T14:32:26.000000Z"
        }
    }
    ```

- Delete Pajak

    method: `DELETE`
    url: `/pajak/{id}`
    params: `id:integer`

    response:

    ```json
    {
        "data": null
    }
    ```

### Item

- Get Item with Pajak

method: `GET`
url: `/item`
params: `none`
response:

```json
{
    "data": [
        {
            "id": 1,
            "nama": "baju batik A",
            "created_at": "2022-07-04T12:15:58.000000Z",
            "updated_at": "2022-07-04T14:09:09.000000Z",
            "pajak": [
                {
                    "id": 1,
                    "nama": "pph",
                    "rate": 0.05,
                    "pajak": {
                        "item_id": 1,
                        "pajak_id": 1
                    }
                },
                {
                    "id": 3,
                    "nama": "Pajak C",
                    "rate": 0.03,
                    "pajak": {
                        "item_id": 1,
                        "pajak_id": 3
                    }
                }
            ]
        }
    ]
}
```

- Create Item with Pajak

    method: `POST`
    url: `/item`
    body:

    ```json
    {
        "nama": "Item", (required)
        "pajak_id": [1, 2] (required | array | min:2)
    }
    ```

    response:

    ```json
    {
        "data": {
            "nama": "Item",
            "updated_at": "2022-07-04T14:34:45.000000Z",
            "created_at": "2022-07-04T14:34:45.000000Z",
            "id": 7,
            "pajak": [
                {
                    "id": 1,
                    "nama": "pph",
                    "rate": 0.05,
                    "pajak": {
                        "item_id": 7,
                        "pajak_id": 1
                    }
                },
                {
                    "id": 2,
                    "nama": "pajak toko",
                    "rate": 0.1,
                    "pajak": {
                        "item_id": 7,
                        "pajak_id": 2
                    }
                }
            ]
        }
    }
    ```

- Detail Item with Pajak

    method: `GET`
    url: `/item/{id}`
    params: `id:integer`
    response:

    ```json
    {
        "data": {
            "id": 1,
            "nama": "baju batik A",
            "created_at": "2022-07-04T12:15:58.000000Z",
            "updated_at": "2022-07-04T14:09:09.000000Z",
            "pajak": [
                {
                    "id": 1,
                    "nama": "pph",
                    "rate": 0.05,
                    "pajak": {
                        "item_id": 1,
                        "pajak_id": 1
                    }
                },
                {
                    "id": 3,
                    "nama": "Pajak C",
                    "rate": 0.03,
                    "pajak": {
                        "item_id": 1,
                        "pajak_id": 3
                    }
                }
            ]
        }
    }
    ```

- Update Item with Pajak

    method: `PUT`
    url: `/item/{id}`
    params: `id:integer`
    body:

    ```json
    {
        "nama": "Item", (required)
        "pajak_id": [1, 2] (required | array | min:2)
    }
    ```

    response:

    ```json
    {
        "data": {
            "id": 1,
            "nama": "baju batik A",
            "created_at": "2022-07-04T12:15:58.000000Z",
            "updated_at": "2022-07-04T14:09:09.000000Z",
            "pajak": [
                {
                    "id": 1,
                    "nama": "pph",
                    "rate": 0.05,
                    "pajak": {
                        "item_id": 1,
                        "pajak_id": 1
                    }
                },
                {
                    "id": 3,
                    "nama": "Pajak C",
                    "rate": 0.03,
                    "pajak": {
                        "item_id": 1,
                        "pajak_id": 3
                    }
                }
            ]
        }
    }
    ```

- Delete Item

    method: `DELETE`
    url: `/item/{id}`
    params: `id:integer`
    response:

    ```json
    {
        "data": null
    }
    ```

## About me

Hello there 👋🏻, my name is [Afif Abdillah Jusuf](https://github.com/bungambohlah) and I'm a software engineer.

I'm currently working as a [Full Stack Developer](https://www.linkedin.com/in/afifjusuf/).

Graduated from [Politeknik Elektronika Negeri Surabaya](https://pens.ac.id) as Associate Degree in Informatics Engineering.

Nice to meet you.

Visit my personal site at [afif.dev](https://afif.dev)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
