
debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'

apt-get update
apt-get install -y apache2 php5 mysql-server php5-mysql phpunit php5-curl unzip

mysql -u root --password=password -e "CREATE DATABASE wordpress"

cd /tmp
wget -q https://wordpress.org/latest.zip
unzip latest.zip
cp -r /tmp/wordpress/* /vagrant/
wget -q https://downloads.wordpress.org/plugin/custom-post-type-ui.1.5.2.zip
unzip custom-post-type-ui.1.5.2.zip
mv /tmp/custom-post-type-ui /vagrant/wp-content/plugins/

cp /vagrant/wp-content/plugins/directoki/vagrant/99-custom.ini /etc/php5/apache2/conf.d/
cp /vagrant/wp-content/plugins/directoki/vagrant/apache.conf /etc/apache2/sites-enabled/000-default.conf

chown -R www-data:www-data /vagrant

a2enmod rewrite
/etc/init.d/apache2 restart
