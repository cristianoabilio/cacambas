######################################################################################################################################################
# Rodar os comandos abaixo fora da VM, na Pasta do Projeto
######################################################################################################################################################

sudo apt-get install gem -y
sudo apt-get install node -y
sudo apt-get install npm -y
##### Install NPM / Grunt / Bower / Yeoman / GEM:Compass (Setup Dev) #################################################################################

sudo sh public/front/dev/startup.sh


##### Install Composer (Laravel) #####################################################################################################################

sudo curl -s http://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo rm -rf bootstrap/compiled.php
sudo composer install -vvv
sudo php artisan clear-compiled
sudo php artisan optimize
sudo composer dump-autoload
#sudo composer update --no-scripts -vvv
sudo rm -rf bootstrap/compiled.php
sudo composer update -vvv
sudo php artisan clear-compiled
sudo php artisan optimize


##### Permissions ###################################################################################################################################

sudo chmod -R 777 app/storage
