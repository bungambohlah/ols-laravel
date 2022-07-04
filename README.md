# OLS Laravel

This testing project from PT. Olsera Pratama Indonesia at [Olsera.com](https://olsera.com)

## List of API Routes

### Pajak

* Get Pajak

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

* Create Pajak

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

* Detail Pajak

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

* Update Pajak

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

* Delete Pajak

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

* Get Item with Pajak

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

* Create Item with Pajak

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

* Detail Item with Pajak

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

* Update Item with Pajak

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

* Delete Item

    method: `DELETE`
    url: `/item/{id}`
    params: `id:integer`
    response:

    ```json
    {
        "data": null
    }
    ```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
