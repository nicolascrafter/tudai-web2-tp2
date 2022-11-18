# tudai-web2-tp2
## Importar la base de datos
- abrir PHPMyAdmin o la herramienta de gestion de base de datos
- crear un base de datos con el nombre ```tudai-web2-tp2```
- teniendo seleccionada la base de datos creada importar las tablas en ```db/tudai-web2-tp2.sql```

----

## Documentacion
Contenidos
- [tudai-web2-tp2](#tudai-web2-tp2)
  - [Importar la base de datos](#importar-la-base-de-datos)
  - [Documentacion](#documentacion)
    - [Categorias](#categorias)
      - [GET](#get)
      - [GET por id](#get-por-id)
      - [POST](#post)
      - [PUT](#put)
      - [DELETE](#delete)
    - [Productos](#productos)
      - [GET](#get-1)
      - [GET por id](#get-por-id-1)
      - [GET por categoria](#get-por-categoria)
      - [POST](#post-1)
      - [PUT](#put-1)
      - [DELETE](#delete-1)
    - [Ordenamiento y paginado](#ordenamiento-y-paginado)
      - [Ordenamiento](#ordenamiento)
      - [Paginado](#paginado)

### Categorias
Aca se agrupan todos endpoint asociados al recurso categorias

Endpoint: ```/api/categories```

#### GET

Endpoint: ```/api/categories```<br>
Metodo: ```GET```

Este metodo trae todas las entradas en el recurso categorias<br>
Se puede [ordenar y paginar](#ordenamiento-y-paginado)

Request: ```/api/categories```<br>
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

#### GET por id

Endpoint: ```/api/categories/:ID```<br>
Metodo: ```GET```

Trae una categoria especifica por su id

Request: ```/api/categories/:ID```<br>
Metodo: ```GET```

| Campo | Descripcion           | Tipo |
| ----- | --------------------- | ---- |
| :ID   | El id de la categoria | int  |

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

Endpoint: ```/api/categories```<br>
Metodo: ```POST```

Este metodo permite agregar una nueva categoria

Request: ```/api/categories```<br>
Metodo: ```POST```<br>
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

* :green_circle: 201

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

    | Campo  | Descripcion          | Tipo   | Valor                  |
    | ------ | -------------------- | ------ | ---------------------- |
    | code   | Codigo de error      | string | ```InvalidPostData```  |
    | detail | Detalle del error    | string | ```Datos no validos``` |
    | params | Parametros del error | object | ```{}```               |


    ```json
    {
        "code": "InvalidPostData",
        "detail": "Datos no validos",
        "params": {}
    }
    ```

#### PUT

Endpoint: ```/api/categories/:ID```<br>
Metodo: ```PUT```

Este metodo permite editar una categoria existente

Request: ```/api/categories/:ID```<br>
Metodo: ```PUT```<br>
Body: Un objeto json con los datos de la categoria

| Campo | Descripcion                                 | Tipo   |
| ----- | ------------------------------------------- | ------ |
| :ID   | El id de la categoria                       | int    |
| type  | El tipo de los productos de esta categoria  | string |
| brand | La marca de los productos de esta categoria | string |


```PUT /api/categories/5```
```json
{
    "type": "Monitor",
    "brand": "Noblex"
}
```

Responses

* :green_circle: 201

    Un objeto json con los datos de la categoria modificada

    | Campo | Descripcion                                  | Tipo   |
    | ----- | -------------------------------------------- | ------ |
    | id    | El id de la categoria                        | int    |
    | type  | El tipo de los productos de esta categoria   | string |
    | brand | La marca de los productos de esta categorias | string |

    ```json
    {
        "id": 5,
        "type": "Monitor",
        "brand": "Noblex"
    }
    ```

* :red_circle: 400

    Es recibido cuando los datos de la categoria en el body no tienen el formato correcto

    | Campo  | Descripcion          | Tipo   | Valor                  |
    | ------ | -------------------- | ------ | ---------------------- |
    | code   | Codigo de error      | string | ```InvalidPutData```   |
    | detail | Detalle del error    | string | ```Datos no validos``` |
    | params | Parametros del error | object | ```{}```               |


    ```json
    {
        "code": "InvalidPutData",
        "detail": "Datos no validos",
        "params": {}
    }
    ```

* :red_circle: 400

    Es recibido cuando el id especificado no tiene el formato correcto

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

* :red_circle: 400

    Es recibido cuando la categoria especificada no existe

    | Campo  | Descripcion          | Tipo   | Valor                        |
    | ------ | -------------------- | ------ | ---------------------------- |
    | code   | Codigo de error      | string | ```CategoryDoesNotExist```   |
    | detail | Detalle del error    | string | ```La categoria no existe``` |
    | params | Parametros del error | object | ```{}```                     |


    ```json
    {
        "code": "CategoryDoesNotExist",
        "detail": "La categoria no existe",
        "params": {}
    }
    ```

#### DELETE

Endpoint: ```/api/categories/:ID```<br>
Metodo: ```DELETE```

Este metodo permite borrar una categoria<br>
Para poder borrar una categoria esta no tiene que tener ningun porducto asociado

Request: ```/api/categories/:ID```<br>
Metodo: ```DELETE```

| Campo | Descripcion           | Tipo |
| ----- | --------------------- | ---- |
| :ID   | El id de la categoria | int  |

Responses

* :green_circle: 200

    La categoria se borro exitosamente<br>
    La respuesta contiene la categoria borrada

    | Campo | Descripcion                                 | Tipo   |
    | ----- | ------------------------------------------- | ------ |
    | id    | El id de la categoria                       | int    |
    | type  | El tipo de los productos de esta categoria  | string |
    | brand | La marca de los productos de esta categoria | string |

    ```json
    {
        "id": 5,
        "type": "Monitor",
        "brand": "LG"
    }
    ```

* :red_circle: 400

    Es recibido cuando la categoria contiene productos asociados

    | Campo  | Descripcion          | Tipo   | Valor                               |
    | ------ | -------------------- | ------ | ----------------------------------- |
    | code   | Codigo de error      | string | ```ConflictingItems```              |
    | detail | Detalle del error    | string | ```Hay productos en la categoria``` |
    | params | Parametros del error | object | ```{}```                            |


    ```json
    {
        "code": "ConflictingItems",
        "detail": "Hay productos en la categoria",
        "params": {}
    }
    ```

* :red_circle: 400

    Es recibido cuando el id no tiene el formato correcto

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

* :red_circle: 400

    Es recibido cuando la categoria especificada no existe

    | Campo  | Descripcion          | Tipo   | Valor                        |
    | ------ | -------------------- | ------ | ---------------------------- |
    | code   | Codigo de error      | string | ```CategoryDoesNotExist```   |
    | detail | Detalle del error    | string | ```La categoria no existe``` |
    | params | Parametros del error | object | ```{}```                     |


    ```json
    {
        "code": "CategoryDoesNotExist",
        "detail": "La categoria no existe",
        "params": {}
    }
    ```

### Productos

Endpoint: ```/api/products```

Aca se agrupan todos endpoint asociados al recurso productos

#### GET

Endpoint: ```/api/products```<br>
Metodo: ```GET```

Este metodo permite obtener todos los productos<br>
Se puede [ordenar y paginar](#ordenamiento-y-paginado)

Request: ```/api/products```<br>
Metodo: ```GET```

Resposes:

* :green_circle: 200

    Un arreglo de objetos json con los productos solicitados<br>
    Cada producto tiene las siguiente propiedades

    | Campo       | Descripcion                              | Tipo   |
    | ----------- | ---------------------------------------- | ------ |
    | id          | El id del producto                       | int    |
    | name        | Nombre del producto                      | string |
    | description | Descripcion del producto                 | string |
    | price       | Precio del producto                      | string |
    | stock       | Stock del producto                       | int    |
    | category_id | Categoria a la que pertenece el producto | int    |
    | type        | Tipo de producto (segun su categoria)    | string |
    | brand       | Marca del producto (segun su categoria)  | string |

    ```json
    [
        {
            "id": 1,
            "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
            "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
            "price": "92450.00",
            "stock": 100,
            "category_id": 1,
            "type": "Tarjeta Grafica",
            "brand": "Nvidia"
        },
        {
            "id": 2,
            "name": "Ryzen 5 5600G",
            "description": "MARCA: AMD\r\nMODELO: Ryzen 5 5600G\r\n\r\nEspecificaciones\r\nN.° de núcleos de CPU: 6\r\nN.° de subprocesos: 12\r\nN.° de núcleos de GPU: 7\r\nReloj base: 3.9GHz\r\nReloj de aumento máx.: Hasta 4.4GHz\r\nCaché L2 total: 3MB\r\nCaché L3 total: 16MB\r\nDesbloqueados: Sí\r\nCMOS: TSMC 7nm FinFET\r\nPaquete: AM4\r\nVersión de PCI Express: PCIe® 3.0\r\nSolución térmica: Wraith Stealth\r\nTDP/TDP predeterminado: 65W\r\ncTDP: 45-65W\r\nTemp. máx.: 95°C\r\n*Compatible con SO: Windows 10 edición de 64·bits - RHEL x86 edición de 64·bits - Ubuntu x86 edición de 64·bits\r\n*El soporte del sistema operativo (SO) variará según el fabricante.\r\n\r\nMemoria\r\nVelocidad máxima de memoria: Up to 3200MHz\r\nTipo de memoria: DDR4\r\nCanales de memoria: 2\r\n\r\nEspecificaciones de gráficos\r\nFrecuencia de gráficos: 1900 MHz\r\nModelo de gráficos: Radeon™ Graphics\r\nCant. de núcleos de los gráficos: 7\r\n\r\nFuncionalidades principales\r\nDisplay Port: Sí\r\nHDMI™: Sí\r\n\r\nFundación\r\nFamilia de productos: AMD Ryzen™ Processors\r\nLínea de productos: AMD Ryzen™ 5 5000 G-Series Desktop Processors with Radeon™ Graphics\r\nPlataforma: Boxed Processor\r\nBandeja OPN: 100-000000252\r\nOPN PIB: 100-100000252BOX\r\nOPN MPKL: 100-100000252MPK\r\nFecha de lanzamiento: 4/13/2021",
            "price": "43999.00",
            "stock": 100,
            "category_id": 4,
            "type": "CPU",
            "brand": "AMD"
        }
    ]
    ```

* :red_circle: 4XX
  
    Vease [Ordenamiento y paginado](#ordenamiento-y-paginado)

#### GET por id

Endpoint: ```/api/products/:ID```<br>
Metodo: ```GET```

Este metodo permite obtener un solo producto segun su id

Request: ```/api/products/:ID```<br>
Metodo: ```GET```

| Campo | Descripcion        | Tipo |
| ----- | ------------------ | ---- |
| :ID   | El id del producto | int  |

Responses:

* :green_circle: 200

    Un objeto json con los datos del producto solicitado

| Campo       | Descripcion                              | Tipo   |
| ----------- | ---------------------------------------- | ------ |
| id          | El id del producto                       | int    |
| name        | Nombre del producto                      | string |
| description | Descripcion del producto                 | string |
| price       | Precio del producto                      | string |
| stock       | Stock del producto                       | int    |
| category_id | Categoria a la que pertenece el producto | int    |
| type        | Tipo de producto (segun su categoria)    | string |
| brand       | Marca del producto (segun su categoria)  | string |


```json
{
    "id": 1,
    "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
    "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
    "price": "92450.00",
    "stock": 100,
    "category_id": 1,
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

    Es recibido cuando el producto no existe

    | Campo  | Descripcion          | Tipo   | Valor                       |
    | ------ | -------------------- | ------ | --------------------------- |
    | code   | Codigo de error      | string | ```ProductDoesNotExist```      |
    | detail | Detalle del error    | string | ```El producto no existe``` |
    | params | Parametros del error | object | ```{}```                    |

    ```json
    {
        "code": "ProductDoesNotExist",
        "detail": "El producto no existe",
        "params": {}
    }
    ```

#### GET por categoria

Endpoint: ```/api/products/category/:ID```<br>
Metodo: ```GET```

Este metodo permite obtener productos de una categoria especifica<br>
Se puede [ordenar y paginar](#ordenamiento-y-paginado)

Request: ```/api/products/category/:ID```<br>
Metodo: ```GET```

| Campo | Descripcion           | Tipo |
| ----- | --------------------- | ---- |
| :ID   | El id de la categoria | int  |

Responses:

* :green_circle: 200

    Un arreglo de objetos json con los productos solicitados<br>
    Cada producto tiene las siguientes propiedades

    | Campo       | Descripcion                              | Tipo   |
    | ----------- | ---------------------------------------- | ------ |
    | id          | El id del producto                       | int    |
    | name        | Nombre del producto                      | string |
    | description | Descripcion del producto                 | string |
    | price       | Precio del producto                      | string |
    | stock       | Stock del producto                       | int    |
    | category_id | Categoria a la que pertenece el producto | int    |
    | type        | Tipo de producto (segun su categoria)    | string |
    | brand       | Marca del producto (segun su categoria)  | string |


    ```json
    [
        {
            "id": 1,
            "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
            "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
            "price": "92450.00",
            "stock": 100,
            "category_id": 1,
            "type": "Tarjeta Grafica",
            "brand": "Nvidia"
        }
    ]
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

    | Campo  | Descripcion          | Tipo   | Valor                       |
    | ------ | -------------------- | ------ | --------------------------- |
    | code   | Codigo de error      | string | ```ProductDoesNotExist```      |
    | detail | Detalle del error    | string | ```El producto no existe``` |
    | params | Parametros del error | object | ```{}```                    |

    ```json
    {
        "code": "CategoryDoesNotExist",
        "detail": "La categoria no existe",
        "params": {}
    }
    ```

* :red_circle: 4XX

    Vease [Ordenamiento y paginado](#ordenamiento-y-paginado)

#### POST

Endpoint: ```/api/products```<br>
Metodo: ```POST```

Este metodo permite agregar un producto nuevo

Endpoint: ```/api/products```<br>
Metodo: ```POST```<br>
Body: Un objeto json con los datos del producto

| Campo       | Descripcion                              | Tipo    |
| ----------- | ---------------------------------------- | ------- |
| name        | Nombre del producto                      | string  |
| description | Descripcion del producto                 | string  |
| price       | Precio del producto                      | string* |
| stock       | Stock del producto                       | int     |
| category_id | Categoria a la que pertenece el producto | int     |

price tiene que pasar el siguiente regex: ```/^\d{1,8}\.\d{2}$/```<br>
Esto quiere decir que price puede tener entre 1 y 8 digitos antes del punto y tiene que tener 2 digitos despues del punto

```json
[
    {
        "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
        "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
        "price": "92450.00",
        "stock": 100,
        "category_id": 1
    }
]
```

Responses:

* :green_circle: 201

    Se agrego el producto<br>
    La respuesta contiene el producto creado

    | Campo       | Descripcion                              | Tipo   |
    | ----------- | ---------------------------------------- | ------ |
    | id          | El id del producto                       | int    |
    | name        | Nombre del producto                      | string |
    | description | Descripcion del producto                 | string |
    | price       | Precio del producto                      | string |
    | stock       | Stock del producto                       | int    |
    | category_id | Categoria a la que pertenece el producto | int    |
    | type        | Tipo de producto (segun su categoria)    | string |
    | brand       | Marca del producto (segun su categoria)  | string |


    ```json
    {
        "id": 3,
        "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
        "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
        "price": "92450.00",
        "stock": 100,
        "category_id": 1,
        "type": "Tarjeta Grafica",
        "brand": "Nvidia"
    }
    ```

* :red_circle: 400

    Es recibido cuando los datos del producto en el body de la request no tienen el formato correcto

    | Campo  | Descripcion          | Tipo   | Valor                  |
    | ------ | -------------------- | ------ | ---------------------- |
    | code   | Codigo de error      | string | ```InvalidPostData```  |
    | detail | Detalle del error    | string | ```Datos no validos``` |
    | params | Parametros del error | object | ```{}```               |


    ```json
    {
        "code": "InvalidPostData",
        "detail": "Datos no validos",
        "params": {}
    }
    ```

* :red_circle: 400

    Es recibido cuando la categoria especificada en ```category_id``` no existe

    | Campo  | Descripcion          | Tipo   | Valor                       |
    | ------ | -------------------- | ------ | --------------------------- |
    | code   | Codigo de error      | string | ```ProductDoesNotExist```      |
    | detail | Detalle del error    | string | ```El producto no existe``` |
    | params | Parametros del error | object | ```{}```                    |

    ```json
    {
        "code": "CategoryDoesNotExist",
        "detail": "La categoria no existe",
        "params": {}
    }
    ```

#### PUT

Endpoint: ```/api/products/:ID```<br>
Metodo: ```PUT```

Este metodo permite editar un producto existente

Request: ```/api/products/:ID```<br>
Metodo: ```PUT```<br>
Body: Un objeto json con los datos del producto

| Campo       | Descripcion                              | Tipo    |
| ----------- | ---------------------------------------- | ------- |
| :ID         | El id del producto                       | int     |
| name        | Nombre del producto                      | string  |
| description | Descripcion del producto                 | string  |
| price       | Precio del producto                      | string* |
| stock       | Stock del producto                       | int     |
| category_id | Categoria a la que pertenece el producto | int     |

price tiene que pasar el siguiente regex: ```/^\d{1,8}\.\d{2}$/```<br>
Esto quiere decir que price puede tener entre 1 y 8 digitos antes del punto y tiene que tener 2 digitos despues del punto


```json
{
    "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
    "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
    "price": "92450.00",
    "stock": 50,
    "category_id": 1,
}
```

Responses:

* :green_circle: 200

    El producto se modifico<br>
    La respuesta contiene el producto modificado

    | Campo       | Descripcion                              | Tipo   |
    | ----------- | ---------------------------------------- | ------ |
    | id          | El id del producto                       | int    |
    | name        | Nombre del producto                      | string |
    | description | Descripcion del producto                 | string |
    | price       | Precio del producto                      | string |
    | stock       | Stock del producto                       | int    |
    | category_id | Categoria a la que pertenece el producto | int    |
    | type        | Tipo de producto (segun su categoria)    | string |
    | brand       | Marca del producto (segun su categoria)  | string |


    ```json
    {
        "id": 3,
        "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
        "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
        "price": "92450.00",
        "stock": 50,
        "category_id": 1,
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

* :red_circle: 400

    Es recibido cuando el producto no existe

    | Campo  | Descripcion          | Tipo   | Valor                       |
    | ------ | -------------------- | ------ | --------------------------- |
    | code   | Codigo de error      | string | ```ProductDoesNotExist```      |
    | detail | Detalle del error    | string | ```El producto no existe``` |
    | params | Parametros del error | object | ```{}```                    |

    ```json
    {
        "code": "ProductDoesNotExist",
        "detail": "El producto no existe",
        "params": {}
    }
    ```

* :red_circle: 400

    Es recibido cuando los datos del producto en el body de la request no tienen el formato correcto

    | Campo  | Descripcion          | Tipo   | Valor                  |
    | ------ | -------------------- | ------ | ---------------------- |
    | code   | Codigo de error      | string | ```InvalidPutData```   |
    | detail | Detalle del error    | string | ```Datos no validos``` |
    | params | Parametros del error | object | ```{}```               |


    ```json
    {
        "code": "InvalidPutData",
        "detail": "Datos no validos",
        "params": {}
    }
    ```

* :red_circle: 400

    Es recibido cuando la categoria especificada en ```category_id``` no existe

    | Campo  | Descripcion          | Tipo   | Valor                       |
    | ------ | -------------------- | ------ | --------------------------- |
    | code   | Codigo de error      | string | ```ProductDoesNotExist```      |
    | detail | Detalle del error    | string | ```El producto no existe``` |
    | params | Parametros del error | object | ```{}```                    |

    ```json
    {
        "code": "CategoryDoesNotExist",
        "detail": "La categoria no existe",
        "params": {}
    }
    ```

#### DELETE

Endpoint: ```/api/products/:ID```<br>
Metodo: ```DELETE```

Este metodo permite borrar un producto especifico

Request: ```/api/products/:ID```<br>
Metodo: ```DELETE```

| Campo | Descripcion        | Tipo |
| ----- | ------------------ | ---- |
| :ID   | El id del producto | int  |

Responses:

* :green_circle: 200

    El producto fue borrado exitosamente<br>
    La respuesta contiene le producto borrado

    | Campo       | Descripcion                              | Tipo   |
    | ----------- | ---------------------------------------- | ------ |
    | id          | El id del producto                       | int    |
    | name        | Nombre del producto                      | string |
    | description | Descripcion del producto                 | string |
    | price       | Precio del producto                      | string |
    | stock       | Stock del producto                       | int    |
    | category_id | Categoria a la que pertenece el producto | int    |
    | type        | Tipo de producto (segun su categoria)    | string |
    | brand       | Marca del producto (segun su categoria)  | string |


    ```json
    {
        "id": 3,
        "name": "ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC",
        "description": "Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo",
        "price": "92450.00",
        "stock": 100,
        "category_id": 1,
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

* :red_circle: 400

    Es recibido cuando el producto no existe

    | Campo  | Descripcion          | Tipo   | Valor                       |
    | ------ | -------------------- | ------ | --------------------------- |
    | code   | Codigo de error      | string | ```ProductDoesNotExist```      |
    | detail | Detalle del error    | string | ```El producto no existe``` |
    | params | Parametros del error | object | ```{}```                    |

    ```json
    {
        "code": "ProductDoesNotExist",
        "detail": "El producto no existe",
        "params": {}
    }
    ```

### Ordenamiento y paginado

#### Ordenamiento

Es posible ordenar los resultados de cualquier endpoint compatible por cualquiera de sus campos de forma ascendente o descendente.

Para esto se usan los parametros get ```order``` y ```sort```.

| Campo | Descripcion                                                     | Tipo   |
| ----- | --------------------------------------------------------------- | ------ |
| order | Columna por la que se debe ordenar los resultados               | string |
| sort  | Especifica si se debe ordenar de forma ascendente o descendente | string |


Para ```order``` los valores validos dependen del recurso, valor por defecto: ```id```.<br>

Para ```categories``` los valores valido son
* ```id```
* ```type```
* ```brand```

Para ```products``` los valores valido son
* ```id```
* ```name```
* ```description```
* ```price```
* ```stock```
* ```category_id```
* ```type```
* ```brand```

Con ```sort``` se puede especificar si el ordenamiento es ascendente o descendente, valor por defecto: ```asc```.<br>
Los valores valdos son:
* ```asc``` ordena de forma ascendente
* ```desc``` ordena de forma descendente

Request

```GET /api/categories?order=type&sort=desc```

Responses:
* :green_circle: 2XX

    El contenido de la respuesta depende del recurso solicitado, para el ejemplo de arriba esta seria

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
            "id": 5,
            "type": "Monitor",
            "brand": "LG"
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
        }
    ]
    ```

* :red_circle: 400

    Es recibida cuando la columna para ordenar en ```order``` no es valida

    | Campo          | Descripcion                                        | Tipo          | Valor                   |
    | -------------- | -------------------------------------------------- | ------------- | ----------------------- |
    | code           | Codigo de error                                    | string        | ```InvalidColumn```     |
    | detail         | Detalle del error                                  | string        | ```Columna no valida``` |
    | params         | Parametros del error                               | object        | ```{...}```             |
    | params.columns | Columnas por las que se puede ordenar este recurso | array[string] | ```[...,...]```         |

    ```json
    {
        "code": "InvalidColumn",
        "detail": "Columna no valida",
        "params": {
            "columns": [
                "id",
                "type",
                "brand"
            ]
        }
    }
    ```

#### Paginado

Es posible paginar cualquier endpoint compatible con un tamaño de pagina personalizado

Para esto se usan los parametros get ```page``` y ```size```.<br>

| Campo | Descripcion        | Tipo   |
| ----- | ------------------ | ------ |
| page  | Pagina que mostrar | string |
| sort  | Tamaño de pagina   | string |


```page``` especifica el numero de pagina, a partir de 1 y hasta ```maxpage```, la ultima pagina valida.<br>
Valor por defecto: ```1```

```size``` especifica el tamaño de pagina, siendo 0 interpretado como tamaño infinito y hasta ```maxsize```.<br>
Valor por defecto: ```0```

Request:
```GET /api/categories?page=2&size=2```

Responses:

* :green_circle: 2XX

    La respuesta depende del recurso solicitado, para el ejemplo de arriba seria

    | Campo | Descripcion                                  | Tipo   |
    | ----- | -------------------------------------------- | ------ |
    | id    | El id de la categoria                        | int    |
    | type  | El tipo de los productos de esta categoria   | string |
    | brand | La marca de los productos de esta categorias | string |


    ```json
    [
        {
            "id": 3,
            "type": "CPU",
            "brand": "Intel"
        },
        {
            "id": 4,
            "type": "CPU",
            "brand": "AMD"
        }
    ]
    ```

* :red_circle: 400

    Es recibida cuando el tamaño de pagina especificado es muy chico

    | Campo          | Descripcion             | Tipo   | Valor                    |
    | -------------- | ----------------------- | ------ | ------------------------ |
    | code           | Codigo de error         | string | ```PageTooSmall```       |
    | detail         | Detalle del error       | string | ```Pagina muy pequeña``` |
    | params         | Parametros del error    | object | ```{...}```              |
    | params.minsize | Tamaño minimo de pagina | int    | ```0```                  |
    | params.maxsize | Tamaño maximo de pagina | int    | ```2147483647```         |


    ```json
    {
        "code": "PageTooSmall",
        "detail": "Pagina muy pequeña",
        "params": {
            "minsize": 0,
            "maxsize": 2147483647
        }
    }
    ```

* :red_circle: 400

    Es recibida cuando el tamaño de pagina especificado es muy grande

    | Campo          | Descripcion             | Tipo   | Valor                   |
    | -------------- | ----------------------- | ------ | ----------------------- |
    | code           | Codigo de error         | string | ```PageTooLarge```      |
    | detail         | Detalle del error       | string | ```Pagina muy grande``` |
    | params         | Parametros del error    | object | ```{...}```             |
    | params.minsize | Tamaño minimo de pagina | int    | ```0```                 |
    | params.maxsize | Tamaño maximo de pagina | int    | ```2147483647```        |


    ```json
    {
        "code": "PageTooLarge",
        "detail": "Pagina muy grande",
        "params": {
            "minsize": 0,
            "maxsize": 2147483647
        }
    }
    ```

* :red_circle: 400

    Es recibida cuando el tamaño de pagina especificado no es un numero

    | Campo          | Descripcion             | Tipo   | Valor                            |
    | -------------- | ----------------------- | ------ | -------------------------------- |
    | code           | Codigo de error         | string | ```InvalidPageSize```            |
    | detail         | Detalle del error       | string | ```Tamaño de pagina no valido``` |
    | params         | Parametros del error    | object | ```{...}```                      |
    | params.minsize | Tamaño minimo de pagina | int    | ```0```                          |
    | params.maxsize | Tamaño maximo de pagina | int    | ```2147483647```                 |


    ```json
    {
        "code": "InvalidPageSize",
        "detail": "Tamaño de pagina no valido",
        "params": {
            "minsize": 0,
            "maxsize": 2147483647
        }
    }
    ```

* :red_circle: 400

    Es recibida cuando la pagina especificada no es valida

    | Campo          | Descripcion          | Tipo   | Valor                  |
    | -------------- | -------------------- | ------ | ---------------------- |
    | code           | Codigo de error      | string | ```InvalidPage```      |
    | detail         | Detalle del error    | string | ```Pagina no valida``` |
    | params         | Parametros del error | object | ```{...}```            |
    | params.maxpage | Ultima pagina valda  | int    | ```1```                |

    ```json
    {
        "code": "InvalidPage",
        "detail": "Pagina no valida",
        "params": {
            "maxpage": 1
        }
    }
    ```