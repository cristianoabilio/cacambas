######################################################################################################################################################################################
# Rodar os comandos abaixo dentro da VM
######################################################################################################################################################################################


##### Update apt-get #################################################################################################################################################################
sudo apt-get -y update
sudo apt-get -y upgrade


##### Install Apache and Link vagrant-www ###########################################################################################################################################
sudo apt-get install -y apache2
sudo ln -fs /vagrant /var/www


##### Add add-apt-repository binary #################################################################################################################################################

sudo apt-get install python-software-properties
sudo apt-get update


##### Install PHP 5.4 ###############################################################################################################################################################

sudo add-apt-repository ppa:ondrej/php5-oldstable


###### Update #######################################################################################################################################################################

sudo apt-get update
sudo apt-get upgrade
sudo apt-get update && sudo apt-get dist-upgrade

#sudo apt-get install -y ppa-purge
#sudo add-apt-repository -y ppa:ondrej/php5-oldstable
#sudo apt-get update
#sudo ppa-purge ppa:ondrej/php5
#sudo apt-get update 
#sudo apt-get upgrade -y 
#sudo apt-get autoremove -y 
#sudo apt-get autoclean


##### Install Others PHP Libs #######################################################################################################################################################

sudo apt-get install php5 php5-mcrypt libapache2-mod-php5 curl php5-cli apache2-mpm-prefork apache2-utils apache2.2-common  libapr1 libaprutil1 libdbd-mysql-perl libdbi-perl libnet-daemon-perl libplrpc-perl libpq5 mysql-client-5.5 mysql-common mysql-server mysql-server-5.5 php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mysql php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl sysv-rc-conf chkconfig

sudo apt-get install php5-commom


##### Restart Apache ################################################################################################################################################################

sudo service apache2 restart
sudo /etc/init.d/apache2 restart


##### Apache Configs ################################################################################################################################################################

sudo a2enmod rewrite
sudo cp default.vhost /etc/apache2/sites-available/default
sudo a2ensite default
sudo sh -c 'echo "ServerName localhost" >> /etc/apache2/conf.d/name' && sudo service apache2 restart


##### Permissions ##################################################################################################################################################################

sudo usermod -a -G vagrant www-data
sudo chmod -R 755 *
sudo chmod -R 777 /vagrant/app/storage
sudo chmod -R  g+w /vagrant/app/storage/logs/


##### DataBase and Migrations ######################################################################################################################################################

sudo find app/database/migrations/ -type f -name '*create_session_table.php' -delete
sudo find app/database/migrations/ -type f -name '*failed_jobs_table.php' -delete
sudo echo "create database cacambas" | mysql -u root -p
sudo php artisan session:table
sudo php artisan queue:failed-table
sudo php artisan migrate
sudo php artisan db:seed
sudo php artisan optimize


##### MySQL / Apache Startup #######################################################################################################################################################
#sudo /sbin/chkconfig mysqld on
#sudo cp /usr/local/mysql/share/mysql/mysql.server /etc/init.d/mysql
#sudo update-rc.d mysql defaults
#sudo cp /usr/local/apache2/bin/apachectl /etc/init.d/apache
#sudo update-rc.d apache defaults
