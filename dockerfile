# Gunakan image PHP resmi
FROM php:8.1-apache

# Setel direktori kerja
WORKDIR /var/www/html

# Salin file aplikasi Anda ke dalam container
COPY . /var/www/html

# Expose port 80
EXPOSE 80
