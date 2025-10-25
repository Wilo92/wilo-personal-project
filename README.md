# 🛍️ Proyecto tienda (En desarrollo)

Sistema de autenticación y gestión de tienda desarrollado con **Laravel**, **Blade**, **PHP** y **Bootstrap**.  
Incluye login seguro, sesiones autenticadas y vistas dinámicas con diseño moderno.

---

## Tecnologías utilizadas

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Blade](https://img.shields.io/badge/Blade_Template-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-000?style=for-the-badge&logo=github&logoColor=white)

---

## Instalación y configuración

### 1️Clonar el repositorio
```bash
git clone https://github.com/Wilo92/wilo-personal-project.git
cd wilo-personal-project
```

### Instalar dependencias
```bash
composer install
npm install
```

### Configurar el entorno
Copia el archivo de ejemplo y configura tu entorno local:
```bash
cp .env.example .env
```

Edita el archivo `.env` y agrega tus datos de conexión a la base de datos:
```
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### Generar la clave de la aplicación
```bash
php artisan key:generate
```

### Ejecutar las migraciones
```bash
php artisan migrate
```

### Iniciar el servidor local
```bash
php artisan serve
```

Luego abre en tu navegador: **http://127.0.0.1:8000**

---

## Credenciales de prueba
Puedes crear un usuario desde **phpMyAdmin**, con **Tinker** o desde la ventana de autenticacion :
```bash
php artisan tinker
>>> \App\Models\User::create(['name' => 'Wilo', 'email' => 'admin@gmail.com', 'password' => bcrypt('123456')]);
```

---

## 👨‍💻 Autor

**Wilmer Restrepo**  
Alias: **WILO**  
**wilmer.restrepo@hotmail.com**  
🌐 [GitHub: Wilo92](https://github.com/Wilo92/wilo-personal-project)

---

## Comandos útiles

| Comando | Descripción |
|----------|--------------|
| `php artisan serve` | Inicia el servidor local |
| `php artisan migrate` | Ejecuta las migraciones |
| `php artisan make:model Nombre -m` | Crea un modelo con migración |
| `git add . && git commit -m "mensaje"` | Guarda los cambios en Git |
| `git push origin main` | Sube los cambios al repositorio remoto |

---

## Licencia
Proyecto desarrollado con fines educativos y de práctica personal por **Wilmer Restrepo (WILO)**.

---
