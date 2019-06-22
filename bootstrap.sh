#!/bin/bash

sudo apt-get install python-software-properties -y
sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install php7.3 php7.3-fpm php7.3-mysql php7.3-mcrypt php7.3-mbstring php7.3-xml php7.3-curl php7.3-zip -y
sudo apt-get --purge autoremove -y
sudo service php7.3-fpm restart

sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo apt-get -y install mysql-server mysql-client

sudo apt-get install apache2 libapache2-mod-php7.3 -y
sudo tee /etc/apache2/mods-enabled/dir.conf <<- EOM
<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>
EOM

sudo tee /etc/apache2/sites-enabled/000-default.conf <<- EOM
<VirtualHost *:80>
	ServerAdmin brunorodriguesholanda@gmail.com
	DocumentRoot /vagrant/public
	<Directory "/vagrant/public">
	    Options Indexes FollowSymLinks
		AllowOverride All
		Require all granted
	</Directory>
</VirtualHost>
EOM

sudo tee -a /etc/apache2/apache2.conf <<- EOM
	ServerName vagrant
EOM

#LINE=`grep -n 'User \${APACHE_RUN_USER\}' /etc/apache2/apache2.conf | cut -d ':' -f 1`
#sudo sed -i "$LINE"'s/.*/User vagrant/' /etc/apache2/apache2.conf

LINE=`grep -n 'short_open_tag = Off' /etc/php/7.3/apache2/php.ini | cut -d ':' -f 1`
sudo sed -i "$LINE"'s/.*/short_open_tag = On/' /etc/php/7.3/apache2/php.ini

LINE=`grep -n 'error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT' /etc/php/7.3/apache2/php.ini | cut -d ':' -f 1`
sudo sed -i "$LINE"'s/.*/error_reporting = E_ALL/' /etc/php/7.3/apache2/php.ini

LINE=`grep -n 'display_errors = Off' /etc/php/7.3/apache2/php.ini | cut -d ':' -f 1`
sudo sed -i "$LINE"'s/.*/display_errors = On/' /etc/php/7.3/apache2/php.ini

LINE=`grep -n 'bind-address' /etc/mysql/my.cnf  | cut -d ':' -f 1`
sudo sed -i "$LINE"'s/.*/# bind-address = 127.0.0.1/' /etc/mysql/my.cnf

sudo a2enmod rewrite

sudo service apache2 restart

sudo service mysql restart

# Configuração para Composer
sudo dd if=/dev/zero of=/var/swap.1 bs=1M count=1024
sudo mkswap /var/swap.1
sudo swapon /var/swap.1
sudo apt-get install git -y
sudo apt-get install unzip -y

# Instalar composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin
php -r "unlink('composer-setup.php');"
sudo ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

#Instalar nodejs
sudo apt-get install curl python-software-properties -y
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo apt-get install nodejs -y

#Instalar laravel
sudo apt install php7.3-zip -y
sudo apt install php7.3-mbstring -y
sudo apt install php7.3-bcmath -y
sudo apt install php7.3-xml -y
sudo apt install php7.3-curl -y
sudo apt install libpng-dev -y

composer global require laravel/installer

export PATH=$PATH:$HOME/.config/composer/vendor/bin

composer install

# Após a instalação rodar fora do vagrant
# npm install
# npm run watch
