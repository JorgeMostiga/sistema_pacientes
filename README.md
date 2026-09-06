# Sistema de Registro de Pacientes

Este es un sistema web desarrollado con **Laravel** diseñado para la gestión integral de pacientes, historiales clínicos, sesiones de tratamiento y control de acceso por roles.

## Características Principales

- **Gestión de Usuarios:** Control de acceso basado en roles (Administrador, Médico, Licenciado, Paciente).
- **Gestión de Pacientes:** Registro y seguimiento de pacientes.
- **Historial Clínico:** Creación y visualización de fichas de tratamiento.
- **Control de Sesiones:** Seguimiento de sesiones para cada tratamiento.
- **Exportación:** Generación de reportes en PDF para los tratamientos.

## Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- Base de datos (MySQL o SQLite)
- Node.js (para la compilación de assets)

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone <url-del-repositorio>
   ```
2. Instalar dependencias de PHP:
   ```bash
   composer install
   ```
3. Instalar dependencias de JS:
   ```bash
   npm install && npm run build
   ```
4. Configurar el archivo `.env` basándose en el `.env.example`.
5. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

## Roles de Usuario
- **Admin:** Gestión total de usuarios del sistema.
- **Médico/Licenciado:** Gestión de pacientes, fichas y sesiones de tratamiento.
- **Paciente:** Acceso a su información personal.
