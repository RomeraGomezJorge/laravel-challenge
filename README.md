## Gestor de Descuentos para Plataforma de Alquiler de Vehículos
Este reto se enfoca en la creación de un Gestor de Descuentos (ABM) para una plataforma de alquiler de vehículos. Permite configurar descuentos según el tipo de acceso, marca de rentadora y región de alquiler, facilitando la administración efectiva de promociones. Incluye funciones de autenticación de usuarios, formularios de alta y edición, listados detallados con filtros y soporte multilenguaje.

## Carpeta de Requisitos del Reto ( 01-requisitos-del-reto )
En esta carpeta, encontrarás todos los elementos necesarios para comprender y abordar el desafío propuesto.

### Contenido:
1. <b>Requisitos en PDF :</b>
    Consulta el archivo requisitos.pdf para obtener detalles sobre los requisitos del desafío. Este documento proporciona la información esencial que necesita para completar la tarea.

2. <b>Archivos de SQL:</b>
    Los archivos database_ddl.sql y database_data.sql contienen las consultas SQL utilizadas para crear las migraciones necesarias.
    
3. <b>Imágenes de la Estructura del Front-end:</b>
    Las imágenes form.png y list.png ofrecen visualizaciones detalladas de la estructura requerida para el front-end. Úsalas como referencia para garantizar una implementación precisa.

## Guía para Levantar el Proyecto en Laravel 8

### Requisitos Previos
Antes de comenzar, asegúrate de tener instalados los siguientes componentes en tu entorno de desarrollo:

- PHP >= 7.3
- Composer
- Npm 
- GIT
- MySQL o un sistema de gestión de bases de datos compatible

### Pasos para Levantar el Proyecto
Sigue estos pasos cuidadosamente para configurar y ejecutar tu proyecto Laravel 8 de manera eficiente.

1. **Clonar el Repositorio**

   Clona este repositorio en la carpeta pública de tu servidor web. Puedes utilizar el siguiente comando para clonar el repositorio:

    ```
    git clone https://github.com/RomeraGomezJorge/laravel-challenge.git
    ``` 



2. **Configurar la Base de Datos**

   Asegúrate de que la base de datos `discounts_management` esté creada en tu servidor de base de datos. Puedes utilizar una herramienta como phpMyAdmin o ejecutar el siguiente comando SQL en tu servidor MySQL:

    ```
    CREATE DATABASE discounts_management;
    ```


3. **Configurar el Archivo de Entorno**

    Copia el archivo `.env.example` a `.env` y edita el archivo para configurar correctamente la conexión a tu base de datos MySQL. Asegúrate de proporcionar las credenciales adecuadas:

    ```
    cp .env.example .env
    nano .env    
    ```


4. **Instalar Dependencias del Proyecto**

    Instala las dependencias del proyecto utilizando Composer. Ejecuta el siguiente comando desde la carpeta raíz del proyecto:

    ```
    composer install
    ```
5. **Generar una Clave de Aplicación Única**

    ```
    php artisan key:generate
    ```

6. **Ejecutar las Migraciones y Seeder**

    Ejecuta las migraciones para crear las tablas de la base de datos y siembra la base de datos con datos predeterminados:
    ```
    php artisan migrate:fresh --seed
    ```

7. **Optimizar tu Aplicación**

    Optimiza tu aplicación para renovar la caché y evitar problemas con rutas en caché que puedan entrar en conflicto con el despliegue:

   ```
    php artisan optimize
    ```


8. **Configurar Permisos en Linux (Solo para Sistemas Linux)**
 
    En sistemas Linux, es fundamental configurar adecuadamente los permisos de la carpeta `storage` para garantizar que Laravel pueda funcionar sin problemas. Puedes hacerlo ejecutando los siguientes comandos desde la raíz de tu proyecto:
    ```
    sudo chgrp -R www-data storage bootstrap/cache
    sudo chmod -R ug+rwx storage bootstrap/
    ```

9. **Iniciar un servidor de desarrollo local.**
    ```
    php artisan serve
   ```
10. **Generar estilos y scripts de desarrollo**   
    ```
    npm run dev
    ```   
11. **Acceder al Sitio Web**
Tu proyecto Laravel 8 ahora está configurado y en funcionamiento correctamente. Puedes acceder al sitio web utilizando tu navegador web. Inicia sesión con las siguientes credenciales:

- Usuario: admin@example.com
- Contraseña: password


   
   


