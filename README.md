symfony3-boilerplate-fos-clean-blog
========================

Welcome to symfony3-boilerplate-fos-clean-blog - a fully-functional 
application that you can use as the skeleton for your new applications.

What's inside?
--------------

The symfony3-boilerplate-fos-clean-blog is configured with the following defaults:

  * symfony3.3

  * bootstrap4

  * the theme : clean blog https://startbootstrap.com/template-overviews/clean-blog/

It comes pre-configured with the following bundles:

  * [**FOSUserBundle**][6]

Enjoy!

Setup
-----
- install xamp (use standard password encryption for mysql8)
- install composer
- npm install -g bower
- bower install
- do "composer install"
- set the virtual host in C:\xampp\apache\conf\extra\httpd-vhosts.conf
like this :

<VirtualHost *:80>
    ServerAdmin patricerolland@yahoo.fr
    DocumentRoot "C:\dvt\symfony3-boilerplate-fos-clean-blog\web"
    ServerName test
    ErrorLog "logs/test-error.log"
    CustomLog "logs/test-access.log" common
    <Directory "C:\dvt\symfony3-boilerplate-fos-clean-blog\web">
        Require all granted    
    </Directory>
</VirtualHost>

- go to http://localhost/app_dev.php
