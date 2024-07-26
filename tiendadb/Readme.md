# TiendaDB

Este proyecto proporciona la gestión de la tienda BOC, permitiendo realizar operaciones CRUD sobre entidades como usuarios, categorías, productos, facturas, pedidos e histórico de facturas.

## Uso

La base de datos soporta las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para las siguientes entidades: Usuarios, Categorías, Productos, Facturas, Pedidos e Histórico de Facturas.

### Endpoints

#### Usuarios
- **GET /usuarios**: Obtiene todos los usuarios.
- **GET /usuarios/{id}**: Obtiene un usuario por ID.
- **POST /usuarios**: Crea un nuevo usuario.
- **PUT /usuarios/{id}**: Actualiza un usuario por ID.
- **DELETE /usuarios/{id}**: Elimina un usuario por ID.

#### Categorías
- **GET /categorias**: Obtiene todas las categorías.
- **GET /categorias/{id}**: Obtiene una categoría por ID.
- **POST /categorias**: Crea una nueva categoría.
- **PUT /categorias/{id}**: Actualiza una categoría por ID.
- **DELETE /categorias/{id}**: Elimina una categoría por ID.

#### Productos
- **GET /productos**: Obtiene todos los productos.
- **GET /productos/{id}**: Obtiene un producto por ID.
- **POST /productos**: Crea un nuevo producto.
- **PUT /productos/{id}**: Actualiza un producto por ID.
- **DELETE /productos/{id}**: Elimina un producto por ID.

#### Facturas
- **GET /facturas**: Obtiene todas las facturas.
- **GET /facturas/{id}**: Obtiene una factura por ID.
- **POST /facturas**: Crea una nueva factura.
- **PUT /facturas/{id}**: Actualiza una factura por ID.
- **DELETE /facturas/{id}**: Elimina una factura por ID.

#### Pedidos
- **GET /pedidos**: Obtiene todos los pedidos.
- **GET /pedidos/{id}**: Obtiene un pedido por ID.
- **POST /pedidos**: Crea un nuevo pedido.
- **PUT /pedidos/{id}**: Actualiza un pedido por ID.
- **DELETE /pedidos/{id}**: Elimina un pedido por ID.

#### Histórico de Facturas
- **GET /historico**: Obtiene el histórico de facturas.
- **GET /historico/{id}**: Obtiene un registro de histórico de factura por ID.
- **POST /historico**: Crea un nuevo registro en el histórico de facturas.
- **PUT /historico/{id}**: Actualiza un registro en el histórico de facturas por ID.
- **DELETE /historico/{id}**: Elimina un registro en el histórico de facturas por ID.

### Reportes

*(Nota: La sección de reportes aún no ha sido definida.)*

## Estructura del Proyecto

El proyecto está organizado de la siguiente manera:

tiendadb/
├── public/
│   ├── frontend.php
│   ├── index.php
│   ├── styles.css
│   ├── error/
│   │   └── response.html
│   └── scripts/
│       ├── marcas-con-ventas.js
│       ├── marcas.js
│       ├── prendas-vendidas.js
│       ├── prendas.js
│       ├── top5.js
│       └── ventas.js
├── src/
│   ├── routes.php
│   ├── controllers/
│   │   ├── CategoriaController.php
│   │   ├── FacturaController.php
│   │   ├── HistoricoUsuarioController.php
│   │   ├── PedidoController.php
│   │   ├── ProductoController.php
│   │   └── UsuarioController.php
│   ├── db/
│   │   ├── Database.php
│   │   └── tiendadb.sql
│   └── module/
│       ├── Categoria.php
│       ├── Factura.php
│       ├── HistoricoUsuario.php
│       ├── Pedido.php
│       ├── Producto.php
│       └── Usuario.php
└── README.md

### Detalles de los Archivos

- **`public/frontend.php`**: Archivo principal para la interfaz de usuario del proyecto. Contiene el HTML y las conexiones a los scripts JavaScript.
- **`public/index.php`**: Punto de entrada para las peticiones a la base de datos. Maneja las rutas y las solicitudes.
- **`public/styles.css`**: Contiene los estilos personalizados para la interfaz.
- **`public/error/response.html`**: Página de error personalizada.
- **`public/scripts/`**: Carpeta que contiene los archivos JavaScript para la interacción con la base de datos.
  - `marcas-con-ventas.js`: Maneja la visualización de categorías con ventas.
  - `marcas.js`: Maneja la visualización y gestión de categorías.
  - `prendas-vendidas.js`: Maneja la visualización de productos vendidos.
  - `prendas.js`: Maneja la visualización y gestión de productos.
  - `top5.js`: Maneja la visualización del top 5 de categorías.
  - `ventas.js`: Maneja la visualización y gestión de ventas.
- **`src/controllers/`**: Carpeta que contiene los controladores para manejar la lógica de negocio.
  - `CategoriaController.php`: Controlador para las operaciones relacionadas con categorías.
  - `FacturaController.php`: Controlador para las operaciones relacionadas con facturas.
  - `HistoricoUsuarioController.php`: Controlador para las operaciones relacionadas con histórico de usuarios.
  - `PedidoController.php`: Controlador para las operaciones relacionadas con pedidos.
  - `ProductoController.php`: Controlador para las operaciones relacionadas con productos.
  - `UsuarioController.php`: Controlador para las operaciones relacionadas con usuarios.
- **`src/db/Database.php`**: Archivo para la conexión con la base de datos.
- **`src/db/tiendadb.sql`**: Script SQL para crear la base de datos y las tablas.
- **`src/module/`**: Carpeta que contiene los modelos para interactuar con la base de datos.
  - `Categoria.php`: Modelo para la entidad Categoría.
  - `Factura.php`: Modelo para la entidad Factura.
  - `HistoricoUsuario.php`: Modelo para la entidad Histórico de Usuario.
  - `Pedido.php`: Modelo para la entidad Pedido.
  - `Producto.php`: Modelo para la entidad Producto.
  - `Usuario.php`: Modelo para la entidad Usuario.
- **`src/routes.php`**: Archivo de configuración de rutas para la base de datos.
