FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt upgrade -y
RUN apt install apache2 -y
RUN apt install -y php libapache2-mod-php php-mysql
RUN apt install -y nano git --fix-missing
RUN rm /var/www/html/index.html
COPY . /var/www/html/
CMD ["apache2ctl", "-D", "FOREGROUND"]