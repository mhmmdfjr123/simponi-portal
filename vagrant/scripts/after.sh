#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
#
# Author: Efriandika Pratama <efriandika.pratama@bni.co.id>

echo "Updating repositories..."
sudo apt-get -qq update

echo "Installing extra PHP extensions..."
sudo apt-get install -y --force-yes unzip php7.1-mcrypt

echo "PHP OCI8 Driver Installation..."
sudo mkdir /opt/oracle && cd /opt/oracle

# echo "Downloading Oracle Instant Client binaries - this may take a while..."
# wget --quiet https://dl.dropboxusercontent.com/u/582415/linux/instantclient-basic-linux.x64-12.1.0.2.0.zip
# wget --quiet https://dl.dropboxusercontent.com/u/582415/linux/instantclient-sdk-linux.x64-12.1.0.2.0.zip

echo "Copy Oracle Instant Client binaries form project_root/vagrant/oracle"
sudo cp /home/vagrant/simponi-portal/vagrant/oracle/* .

sudo unzip \*.zip
cd instantclient_12_1
sudo ln -s libnnz12.so libnnz.so
sudo ln -s libclntshcore.so.12.1 libclntshcore.so
sudo ln -s libclntsh.so.12.1 libclntsh.so
sudo ln -s libocci.so.12.1 libocci.so
export LD_LIBRARY_PATH=/opt/oracle/instantclient_12_1:$LD_LIBRARY_PATH

echo "Re-install PEAR..."
sudo apt-get -y --force-yes remove php-pear --purge
sudo apt-get -y --force-yes install php-pear

sudo pear config-set php_dir /usr/share/php/PEAR

echo 'include_path=".:/usr/share/php:/usr/share/php/PEAR"' | sudo tee --append /etc/php/7.1/fpm/php.ini
echo 'include_path=".:/usr/share/php:/usr/share/php/PEAR"' | sudo tee --append /etc/php/7.1/cli/php.ini

echo "Restarting services..."
sudo service php7.1-fpm restart
sudo service nginx restart;

sudo pecl channel-update pecl.php.net
printf "instantclient,/opt/oracle/instantclient_12_1" | sudo pecl install oci8

echo 'extension=oci8.so' | sudo tee --append /etc/php/7.1/fpm/php.ini
echo 'extension=oci8.so' | sudo tee --append /etc/php/7.1/cli/php.ini

echo "Restarting services..."
sudo service php7.1-fpm restart
sudo service nginx restart;

echo "PHP OCI8 Driver Installation is Completed"
echo "You are ready to Rock!"

