# PHP 8.1 kèm Apache
FROM php:8.1-apache

# Cài extension MySQL để kết nối DB sau này (nếu cần)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Bật mod_rewrite để .htaccess hoạt động
RUN a2enmod rewrite
RUN sed -ri 's/AllowOverride None/AllowOverride All/i' /etc/apache2/apache2.conf

# Copy toàn bộ code vào thư mục web của Apache
COPY . /var/www/html/

# Apache sẽ chạy ở port 80 (Render sẽ map $PORT vào đây)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
