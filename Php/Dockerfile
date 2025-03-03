# Use an official PHP image as a parent image
FROM php:8.2-apache

WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html


# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]