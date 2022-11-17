# tudai-web2-tp2
## Importar la base de datos
- abrir PHPMyAdmin o la herramienta de gestion de base de datos
- crear un base de datos con el nombre ```tudai-web2-tp2```
- teniendo seleccionada la base de datos creada importar las tablas en ```db/tudai-web2-tp2.sql```

----

## Documentacion
Contenidos
1. [Categorias](#categorias)
    1. GET
    2. GET por id
    3. POST
    4. PUT
    5. DELETE
2. [Productos](#productos)
    1. GET
    2. GET por id
    3. GET por categoria
    4. POST
    5. PUT
    6. DELETE
3. [Ordenamiento y paginado](#ordenamiento-y-paginado)

### Categorias
Aca se agrupan todos endpoint asociados al recurso categorias

Endpoint: ```/api/categories```

#### GET

Endpoint: ```/api/categories```
Metodo: ```GET```

Este metodo trae todas las entradas en el recurso categorias, se puede [ordenar y paginar](#ordenamiento-y-paginado)

Request: ```/api/categories```
Metodo: ```GET```

Responses:
* :green_circle: 200

    Un arreglo de objetos json donde cada elemento tiene las siguientes propiedades

    | Campo | Descripcion                                  | Tipo   |
    | ----- | -------------------------------------------- | ------ |
    | id    | El id de la categoria                        | int    |
    | type  | El tipo de los productos de esta categoria   | string |
    | brand | La marca de los productos de esta categorias | string |

    ```json
    [
        {
            "id": 1,
            "type": "Tarjeta Grafica",
            "brand": "Nvidia"
        },
        {
            "id": 2,
            "type": "Tarjeta Grafica",
            "brand": "AMD"
        },
        {
            "id": 3,
            "type": "CPU",
            "brand": "Intel"
        },
        {
            "id": 4,
            "type": "CPU",
            "brand": "AMD"
        },
        {
            "id": 5,
            "type": "Monitor",
            "brand": "LG"
        }
    ]
    ```

* :red_circle: 4XX

    Vease [Ordenamiento y paginado](#ordenamiento-y-paginado)

### GET por id

Endpoint: ```/api/categories/:ID```
Metodo: ```GET```

Trae una categoria especifica por su id

Request: ```/api/categories/:ID```
Metodo: ```GET```

| Campo | Descripcion           | Tipo |
| ----- | --------------------- | ---- |
| id    | El id de la categoria | int  |

Responses:

* :green_circle: 200

    Un objeto json con la categoria solicitada, este objeto tiene las siguientes propiedades

    | Campo | Descripcion                                  | Tipo   |
    | ----- | -------------------------------------------- | ------ |
    | id    | El id de la categoria                        | int    |
    | type  | El tipo de los productos de esta categoria   | string |
    | brand | La marca de los productos de esta categorias | string |

    ```json
    {
        "id": 1,
        "type": "Tarjeta Grafica",
        "brand": "Nvidia"
    }
    ```

* :red_circle: 400

    Es recibido cuando el id no es un numero

    | Campo  | Descripcion          | Tipo   | Valor              |
    | ------ | -------------------- | ------ | ------------------ |
    | code   | Codigo de error      | string | ```InvalidID```    |
    | detail | Detalle del error    | string | ```ID no valido``` |
    | params | Parametros del error | object | ```{}```           |

    ```json
    {
        "code": "InvalidID",
        "detail": "ID no valido",
        "params": {}
    }
    ```

* :red_circle: 404

    Es recibido cuando la categoria no existe

    | Campo  | Descripcion          | Tipo   | Valor                        |
    | ------ | -------------------- | ------ | ---------------------------- |
    | code   | Codigo de error      | string | ```CategoryDoesExist```      |
    | detail | Detalle del error    | string | ```La categoria no existe``` |
    | params | Parametros del error | object | ```{}```                     |

    ```json
    {
        "code": "CategoryDoesExist",
        "detail": "La categoria no existe",
        "params": {}
    }
    ```

#### POST

Endpoint: ```/api/categories```
Metodo: ```POST```

Este metodo permite agregar una nueva categoria

Request: ```/api/categories```
Metodo: ```POST```
Body: Un objeto json con los datos de la categoria

| Campo | Descripcion                                 | Tipo   |
| ----- | ------------------------------------------- | ------ |
| type  | El tipo de los productos de esta categoria  | string |
| brand | La marca de los productos de esta categoria | string |

```json
{
    "type": "Monitor",
    "brand": "Samsung"
}
```

Responses

* :green_circle: 200

    Un objeto json con la categoria creada

    | Campo | Descripcion                                  | Tipo   |
    | ----- | -------------------------------------------- | ------ |
    | id    | El id de la categoria                        | int    |
    | type  | El tipo de los productos de esta categoria   | string |
    | brand | La marca de los productos de esta categorias | string |

    ```json
    {
        "id": 6,
        "type": "Monitor",
        "brand": "Samsung"
    }
    ```

* :red_circle: 400

    Es recibido cuando los datos en el body de la reques tienen el formato incorrecto

    | Campo  | Descripcion          | Tipo   | Valor                        |
    | ------ | -------------------- | ------ | ---------------------------- |
    | code   | Codigo de error      | string | ```InvalidPostData```      |
    | detail | Detalle del error    | string | ```Datos no validos``` |
    | params | Parametros del error | object | ```{}```                     |


    ```json
    {
        "code": "InvalidPostData",
        "detail": "Datos no validos",
        "params": {}
    }
    ```

### Productos

### Ordenamiento y paginado