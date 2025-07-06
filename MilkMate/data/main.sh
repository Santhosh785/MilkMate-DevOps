#! /bin/bash

touch /var/helloworld
git clone https://github.com/Santhosh785/MilkMate.git /var/www/html
/usr/sbin/apache2ctl -D FOREGROUND
