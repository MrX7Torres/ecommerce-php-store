# 🛒 eCommerce PHP Store

This project simulates an online store built with **PHP** and **MySQL**, featuring a client-side shopping experience and an administrative dashboard.  
Users can browse products, manage a shopping cart, and place orders, while administrators can manage employees, products, promotions, and orders through a secure panel.

## 📦 Features

### 👤 Client Side
- User registration and login
- Product catalog with detail view
- Shopping cart and checkout functionality
- Session control and logout

### 🛠️ Admin Side
- Authentication for admin users
- Full CRUD for:
  - Employees
  - Products
  - Promotions
  - Orders
- Image upload per entity
- Organized module structure

## 🧰 Tech Stack

- PHP
- MySQL
- HTML/CSS
- JavaScript (jQuery)

## 📁 Structure

| Path                          | Description                                  |
|-------------------------------|----------------------------------------------|
| `home.php`                    | Home page for clients                        |
| `productos.php`               | Product listing                              |
| `productos_detalle.php`       | Product details                              |
| `carrito01.php`, `carrito02.php` | Shopping cart views                      |
| `agregar_carrito.php`, `pedir_carrito.php` | Cart logic                   |
| `login_cliente.php`, `registro_cliente.php` | Authentication for clients     |
| `cerrar_sesion.php`, `sesion_iniciada.php` | Session management             |
| `menu_clientes.php`, `piePagina.php`        | Page layout and navigation     |
| `ADMIN/`                      | Admin dashboard folder                       |
| └── `empleados_*.php`         | Employee management (CRUD)                   |
| └── `productos_*.php`         | Product management (CRUD)                    |
| └── `promociones_*.php`       | Promotion management (CRUD)                  |
| └── `pedidos_*.php`           | Order management (CRUD)                      |
| └── `funciones/`              | Utilities and DB connection                  |
|     ├── `conecta.php`         | MySQL connection file                        |
|     ├── `libreria.php`        | Helper functions                             |
|     └── `jquery-3.3.1.min.js` | jQuery library                               |
| └── `imgEmpleados/`           | Employee images                              |
| └── `imgProductos/`           | Product images                               |
| └── `imgPromociones/`         | Promotion images                             |

## 🧠 Author

- Jesús Antonio Torres Contreras

## 📚 License
This project is for academic and educational purposes.
