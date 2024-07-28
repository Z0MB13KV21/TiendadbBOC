# TiendaDB

TiendaDB es una aplicación web para la gestión de la tienda BOC, permitiendo realizar operaciones CRUD sobre entidades como usuarios, categorías, productos, facturas, pedidos e histórico de facturas.

## Uso

El sistema soporta operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para las siguientes entidades:

- **Usuarios**
- **Categorías**
- **Productos**
- **Facturas**
- **Pedidos**
- **Histórico de Facturas**

## Endpoints

### Usuarios

- **GET /usuarios**: Obtiene todos los usuarios.
- **GET /usuarios/{id}**: Obtiene un usuario por ID.
- **POST /usuarios**: Crea un nuevo usuario.
- **PUT /usuarios/{id}**: Actualiza un usuario por ID.
- **DELETE /usuarios/{id}**: Elimina un usuario por ID.

### Categorías

- **GET /categorias**: Obtiene todas las categorías.
- **GET /categorias/{id}**: Obtiene una categoría por ID.
- **POST /categorias**: Crea una nueva categoría.
- **PUT /categorias/{id}**: Actualiza una categoría por ID.
- **DELETE /categorias/{id}**: Elimina una categoría por ID.

### Productos

- **GET /productos**: Obtiene todos los productos.
- **GET /productos/{id}**: Obtiene un producto por ID.
- **POST /productos**: Crea un nuevo producto.
- **PUT /productos/{id}**: Actualiza un producto por ID.
- **DELETE /productos/{id}**: Elimina un producto por ID.

### Facturas

- **GET /facturas**: Obtiene todas las facturas.
- **GET /facturas/{id}**: Obtiene una factura por ID.
- **POST /facturas**: Crea una nueva factura.
- **PUT /facturas/{id}**: Actualiza una factura por ID.
- **DELETE /facturas/{id}**: Elimina una factura por ID.

### Pedidos

- **GET /pedidos**: Obtiene todos los pedidos.
- **GET /pedidos/{id}**: Obtiene un pedido por ID.
- **POST /pedidos**: Crea un nuevo pedido.
- **PUT /pedidos/{id}**: Actualiza un pedido por ID.
- **DELETE /pedidos/{id}**: Elimina un pedido por ID.

### Histórico de Facturas

- **GET /historico**: Obtiene el histórico de facturas.
- **GET /historico/{id}**: Obtiene un registro de histórico de factura por ID.
- **POST /historico**: Crea un nuevo registro en el histórico de facturas.
- **PUT /historico/{id}**: Actualiza un registro en el histórico de facturas por ID.
- **DELETE /historico/{id}**: Elimina un registro en el histórico de facturas por ID.

## Estructura del Proyecto

```plaintext
tiendadb/
├── README.md
├── public/
│   ├── index.php
│   ├── error/
│   │   └── response.html
│   ├── frontend/
│   │   ├── admin.php
│   │   ├── index.php
│   │   ├── styles.css
│   │   ├── usuarios.php
│   │   ├── css/
│   │   └── scripts/
│   │       └── usuarios.js
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
# Detalles de los Archivos

## public/
- **index.php**: Punto de entrada para las peticiones a la base de datos. Maneja las rutas y las solicitudes.
- **error/response.html**: Página de error personalizada.
- **frontend/**: Carpeta que contiene los archivos de la interfaz de usuario.
  
## public/frontend/
- **admin.php**: Archivo de administración.
- **index.php**: Archivo principal para la interfaz de usuario.
- **styles.css**: Contiene los estilos personalizados para la interfaz.
- **usuarios.php**: Archivo para la gestión de usuarios.
  
## public/frontend/css/
- **css/**: Carpeta que puede contener archivos CSS adicionales.
  
## public/frontend/scripts/
- **scripts/**: Carpeta que contiene los archivos JavaScript para la interacción con la base de datos.
- **usuarios.js**: Maneja la visualización y gestión de usuarios.

## src/controllers/
- **CategoriaController.php**: Controlador para las operaciones relacionadas con categorías.
- **FacturaController.php**: Controlador para las operaciones relacionadas con facturas.
- **HistoricoUsuarioController.php**: Controlador para las operaciones relacionadas con histórico de usuarios.
- **PedidoController.php**: Controlador para las operaciones relacionadas con pedidos.
- **ProductoController.php**: Controlador para las operaciones relacionadas con productos.
- **UsuarioController.php**: Controlador para las operaciones relacionadas con usuarios.

## src/db/
- **Database.php**: Archivo para la conexión con la base de datos.
- **tiendadb.sql**: Script SQL para crear la base de datos y las tablas.

## src/module/
- **Categoria.php**: Modelo para la entidad Categoría.
- **Factura.php**: Modelo para la entidad Factura.
- **HistoricoUsuario.php**: Modelo para la entidad Histórico de Usuario.
- **Pedido.php**: Modelo para la entidad Pedido.
- **Producto.php**: Modelo para la entidad Producto.
- **Usuario.php**: Modelo para la entidad Usuario.

## src/
- **routes.php**: Archivo de configuración de rutas para la base de datos.

# Requerimientos

## Diseño
- Un diseño atractivo y fácil de navegar que refleje la marca y el contenido.
- Eficiencia en el diseño que cumpla con las necesidades y expectativas de los usuarios.

## Requisitos Funcionales
- Características y comportamientos que el producto o servicio debe tener para cumplir con sus objetivos.
- Páginas de administración con roles diferenciados (Administrador, Cajero, Usuario).

## Requisitos No Funcionales
- Características importantes para el uso y aceptación del producto que no están directamente relacionadas con la funcionalidad.
- Compatibilidad con las últimas versiones de los navegadores más utilizados: Google Chrome, Mozilla Firefox, Opera y Microsoft Edge.

## Contenido
- Información y recursos relevantes y actualizados regularmente.
- La información necesaria para acceder al servidor y subir archivos.

## Seguridad
- Requerir un nombre de usuario y una contraseña para autenticar a los usuarios.
- Verificar la contraseña antes de permitir el acceso.

## Plataforma para Crear la Página Web
- Editor de texto para escribir y editar el código HTML, CSS, PHP y JavaScript.
- Navegador web para diseñar y construir el sitio web.

## Roles
- **Administrador**: Control total sobre la creación, edición y eliminación de artículos, gestión de permisos, y acceso a la gestión de ventas en línea (dashboard).
- **Cajero**: Acceso limitado a la creación, edición y visualización de productos (no puede eliminar productos), y acceso a la gestión de ventas en línea (dashboard).
- **Usuario (cliente)**: Solo puede realizar una compra y gestionar el carrito de compras.

## Filtros (artículos)
- Debe contar con filtros en los artículos para facilitar su búsqueda según su categoría.

## Modals
- Los artículos se mostrarán por medio de modals para evitar el refrescamiento constante de la página y ofrecer una visualización más completa.

## Responsivo
- La aplicación web debe ser responsiva para una buena visualización en diferentes tipos de dispositivos.

## Carrito de Compras
- Debe incluir un carrito de compras para guardar los artículos que el usuario desea comprar, visualizar la cantidad y el total a pagar, y eliminar artículos del carrito.

## Gestión de Ventas en Línea
- Debe incluir una página para visualizar el comportamiento de las ventas, observar qué empleado vendió un artículo y la frecuencia de venta de un artículo.

## Páginas Requeridas
- **Página de Inicio**: Portada con opciones para navegar entre las diferentes páginas y mostrar promociones.
- **Página de Contacto**: Información de contacto de la empresa, incluyendo correo electrónico, dirección y números de teléfono.
- **Quiénes Somos**: Información general de la empresa, incluyendo historia, visión y misión.
- **Productos/Servicios**: Sección para visualizar y navegar los productos y servicios ofrecidos.

## Casos de Uso
- **Inicio de Sesión**
- **Registro de usuario**
- **Historial de compras (usuario)**
- **Navegación de productos (usuario)**
- **Filtrado de productos (usuario)**
- **Realizar una compra (usuario)**
- **Registro de ventas (administrador)**
- **Gestión de productos (administrador)**
- **Gestión de usuarios (administrador)**
- **Creación y edición de promociones (administrador)**

## Validación
- Asegurarse de que todos los formularios están correctamente validados antes de enviar datos al servidor.
- Mostrar mensajes de error claros y útiles debajo de los campos correspondientes.
