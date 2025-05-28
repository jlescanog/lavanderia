# TACSAY - Sistema de Gestión de Lavandería

TACSAY es una aplicación web para la gestión de órdenes de lavandería desarrollada con Laravel y Vue.js. El sistema permite gestionar el flujo completo de órdenes desde su creación hasta su finalización, pasando por diferentes estados de procesamiento.

## Características Principales

- **Gestión de Órdenes**: Creación, seguimiento y actualización de órdenes de lavandería
- **Flujo de Estados**: Las órdenes pasan por diferentes estados (pendiente, en proceso lavado, en proceso planchado, finalizado)
- **Exportación de Datos**: Exportación de órdenes a formatos CSV y PDF con filtros por estado y rango de fechas
- **Validación de Datos**: Sistema robusto de validación de datos de clientes y contraseñas
- **Integración con RENIEC**: Consulta de datos de clientes por DNI a través de la API de RENIEC

## Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- SQLite (configurado en el archivo .env)

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu entorno local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/jlescanog/lavanderia.git
cd lavanderia
```

### 2. Configurar el archivo .env

```bash
cp .env.example .env
```

Edita el archivo `.env` para configurar la conexión a la base de datos SQLite:

```
DB_CONNECTION=sqlite
# Comenta o elimina las siguientes líneas de configuración de MySQL
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Asegúrate de crear el archivo de base de datos SQLite:

```bash
touch database/database.sqlite
```

### 3. Instalar dependencias de PHP (backend - Laravel)

```bash
composer install
```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones y seeders

```bash
php artisan migrate
php artisan db:seed
```

### 6. Instalar dependencias de Node.js (frontend)

```bash
npm install
```

### 7. Compilar los assets del frontend

```bash
npm run dev
```

### 8. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en [http://localhost:8000](http://localhost:8000)

## Estructura del Proyecto

- **app/**: Contiene los modelos, controladores y lógica de negocio
- **resources/js/**: Componentes Vue.js y lógica del frontend
- **resources/views/**: Plantillas Blade y vistas de la aplicación
- **routes/**: Definición de rutas API y web
- **database/**: Migraciones y seeders para la base de datos

## Uso Básico

1. Registra un nuevo cliente o busca uno existente por DNI
2. Crea una nueva orden seleccionando prendas y servicios
3. Sigue el flujo de la orden a través de los diferentes estados
4. Exporta informes de órdenes según necesites

## Contribución

Si deseas contribuir a este proyecto, por favor:

1. Haz un fork del repositorio
2. Crea una rama para tu funcionalidad (`git checkout -b feature/nueva-funcionalidad`)
3. Haz commit de tus cambios (`git commit -am 'Añade nueva funcionalidad'`)
4. Haz push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crea un nuevo Pull Request

## Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo LICENSE para más detalles.
