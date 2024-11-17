# WEB 2-TRABAJO ESPECIAL-PARTE 3

## Tema del trabajo

Helados y Heladerias

## Descripcion

En esta entrega creamos nuestra API RESTful de helados y heladerias cualquier consumidor va a poder acceder a nuestros catalogos de helados y la heladeria correspondiente, mediante el uso de los siguientes metodos **GET**,**POST**,**PUT**,**DELETE**.

http://localhost/TPE_WEB_2_P3/api/helados //para POST, GET
http://localhost/TPE_WEB_2_P3/api/helados/3 //para GET por id, DELETE, PUT

## EndPoints

### Obtener todos los helados (GET)

-Obtiene una coleccion de helados

-Endpoint: http://localhost/TPE_WEB_2_P3/api/helados - Aclaracion: el endpoint anterior es en nuestro caso, en el caso del consumidor debera colocar la ubicacion de donde tendra guardado los archivos del trabajo http://localhost/Ubicacion/api/helados.

-Ejemplo de respuesta del endpoint:

```json
[
    {
        "ID_Helados": 8,
        "Nombre": "Chocolate Blanco",
        "Subcategorias": "Chocolate",
        "Peso": 30,
        "Precio_Costo": 150000,
        "Precio_Venta": 25000,
        "Foto_Helados": "https://static.wikia.nocookie.net/super-helados/images/7/79/Chocolate_blanco.jpg/revision/latest?cb=20211020193911&path-prefix=es",
        "ID_Heladerias": 1
    },
    {
        "ID_Helados": 3,
        "Nombre": "Chocolate",
        "Subcategorias": "Crema",
        "Peso": 5,
        "Precio_Costo": 100000,
        "Precio_Venta": 170000,
        "Foto_Helados": "https://media.cdn.puntobiz.com.ar/102016/1617293962194.jpg?cw=1200&ch=740",
        "ID_Heladerias": 3
    }
]        
```
### En este apartado estan los Opcionales del trabajo

-Si el consumidor lo desea puede hacer combinaciones de los opcionales.

-( 1er Opcional ) : Si el consumidor lo desea puede hacer un "order" con (ID_Helados, Nombre, Subcategoria, Peso, Precio_Costo, Precio_Venta, ID_Heladeria) y "sort" con (ASC,DESC) pasandolos por URL.
    Aclaracion: por default sort = ID_Helados y order ASC. tal cual como se veria en la tabla de la base de datos

-Ejemplo del Opcional 1: http://localhost/WEB_2_P3/api/helados?order=Peso&sort=DESC

-( 2do Opcional ) : Si el consumidor lo desea puede hacer un "limitPage" con un valor entero limitando las solicitudes por pagina y "page" con un valor entero siendo el numero de pagina pasandolos por URL.
    Aclaracion: por default limitPage = 5 y page = 1.

-Ejemplo del Opcional 2: http://localhost/WEB_2_P3/api/helados?limitPage=3&page=1

-( 3er Opcional ) : Si el consumidor lo desea puede filtrar los helados pasando la columna a "queryFiltro"=(ID_Helados, Nombre, Subcategoria, Peso, Precio_Costo, Precio_Venta, ID_Heladeria) y el valor deseado en "filtro".

-Ejemplo del Opcional 3: http://localhost/WEB_2_P3/api/helados?queryFiltro=Nombre&filtro=Chocolate

### Crear un helado (POST)

-Crea un helado para insertarlo en la tabla

-Endpoint: http://localhost/TPE_WEB_2_P3/api/helados - Aclaracion: el endpoint anterior es en nuestro caso, en el caso del consumidor debera colocar la ubicacion de donde tendra guardado los archivos del trabajo http://localhost/Ubicacion/api/helados.

-Ejemplo: en el caso de la heladeria debera colocar una id valida que sea de alguna heladeria ya existente:

#### ID`s validas: ID_Heladerias=1, ID_Heladerias=2, ID_Heladerias=3.

```json
[
    {
    "Nombre": "MentaGranizada",
    "Subcategorias": "Menta",
    "Peso": 5,
    "Precio_Costo": 100000,
    "Precio_Venta": 170000,
    "Foto_Helados": "https://heladoscaseros.com/wp-content/uploads/2017/09/helado-vainilla-casero.jpg",
    "ID_Heladerias": 2
   }
]
```
#### Eliminar un helado (DELETE)

-Elimina un helado de la tabla

-Endpoint: http://localhost/TPE_WEB_2_P3/api/helados/ID - Aclaracion: el endpoint anterior es en nuestro caso,en el caso del consumidor debera colocar la ubicacion de donde tendra guardado los archivos del trabajo http://localhost/TPE_WEB_2_P3/api/helados/ID.

-Ejemplo que funcionaria: http://localhost/TPE_WEB_2_P3/api/helados/8;

#### Editar un helado (PUT)

-Edita un helado de la tabla

-Endpoint: http://localhost/TPE_WEB_2_P3/api/helados/ID - Aclaracion: el endpoint anterior es en nuestro caso,en el caso del consumidor debera colocar la ubicacion de donde tendra guardado los archivos del trabajo http://localhost/TPE_WEB_2_P3/api/helados/ID.

-Ejemplo: en el caso de la heladeria debera colocar una id valida que sea de alguna heladeria ya existente:

#### ID`s validas: ID_Heladerias=1, ID_Heladerias=2, ID_Heladerias=3.

```json
[
    {
    "Nombre": "Nuevo contenido (String)",
    "Subcategorias": "Nuevo contenido (String)",
    "Peso": "Nuevo contenido (int)",
    "Precio_Costo": "Nuevo contenido (int)",
    "Precio_Venta": "Nuevo contenido (int)",
    "Foto_Helados": "Nuevo contenido o null (String)",
    "ID_Heladerias": "Un valor del 1 al 3 (int)"
   }
]
```