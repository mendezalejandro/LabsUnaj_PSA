# Usa una imagen base con PHP y Apache
FROM php:8.0.28-apache

# Copia los archivos de tu aplicación al contenedor
COPY . /var/www/html

# Expone el puerto 80 para que puedas acceder a la aplicación
EXPOSE 80

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Inicia el servidor Apache en primer plano
CMD ["apache2-foreground"]