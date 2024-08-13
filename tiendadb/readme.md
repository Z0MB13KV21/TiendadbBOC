tiendadb/
├── .htaccess
├── AccionCarta.php
├── Configuracion.php
├── error.html
├── index.php
├── La-carta.php
├── log.php
├── ofertas_masvendidos.php
├── Pagos.php
├── PasarelaPago.php
├── perfil.php
├── ProcesarPago.php
├── sobrenosotros.php
├── ventas.php
├── VerCarta.php

├── public/
│   ├── index.php
│   ├── css/
│   │   └── TIndex.css
│   ├── error/
│   │   └── response.html
│   ├── frontend/
│   │   ├── GP.php
│   │   ├── index.php
│   │   ├── productos.php
│   │   ├── usuarios.php
│   │   ├── css/
│   │   │   └── styles.css
│   │   ├── php/
│   │   │   └── GPs.php
│   │   └── scripts/
│   │       ├── añadir.js
│   │       ├── categorias.js
│   │       ├── productos.js
│   │       └── usuarios.js
│   ├── img/
│   │   └── logout.png
│   └── js/
│       ├── cercania.js
│       ├── InicioSesion-Registro.js
│       ├── log.js
│       ├── previo.js
│       ├── Recuperacion.js
│       ├── script.js
│       ├── sublog.js
│       └── ventasmenu.js

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
│   │   ├── auth.php
│   │   ├── Database.php
│   │   ├── logout.php
│   │   ├── tiendadb.sql
│   │   └── verificarRol.php
│   ├── module/
│   │   ├── Categoria.php
│   │   ├── Factura.php
│   │   ├── HistoricoUsuario.php
│   │   ├── Pedido.php
│   │   ├── Producto.php
│   │   └── Usuario.php
│   └── php/
│       ├── InicioSesion-Registro/
│       │   └── login_register.php
│       └── Recuperacion/
│           ├── OlvidoContrasena.php
│           └── RestablecerContrasena.php

└── README.md

# Diagrama de Base de Datos

## Tablas

### Banco
- **id** (PK)
- tarjeta
- CVV
- saldo
- mes
- año

### Categorías
- **IdCateg** (PK)
- NCategoria
- Descripción

### Facturas
- **NFactura** (PK)
- Total
- **IdUser** (FK) -> Usuarios(IdUser)

### Histórico de Usuario
- **IdUser** (FK) -> Usuarios(IdUser)
- Usuario
- **NFactura** (FK) -> Facturas(NFactura)
- **IdPedido** (FK) -> Pedidos(IdPedido)

### Pedidos
- **IdPedido** (PK)
- **NFactura** (FK) -> Facturas(NFactura)
- **IdUser** (FK) -> Usuarios(IdUser)
- Usuario
- Dirección
- Provincia
- Cantón
- NúmeroContacto
- Sede

### Productos
- **IdProduct** (PK)
- NProducto
- Descripción
- Precio
- Stock
- **NCategoria** (FK) -> Categorías(NCategoria)
- enlace
- estado

### Usuarios
- **IdUser** (PK)
- Usuario
- Nombre
- Apellido
- Email
- Contraseña
- Rol
- Estado

## Vistas

### Ofertas
- **IdProduct**
- NProducto
- Descripción
- Precio
- Stock
- NCategoria
- enlace
- estado

### Productos Más Vendidos
- **IdProduct**
- NProducto
- Descripción
- Precio
- Stock
- NCategoria
- enlace
- estado
