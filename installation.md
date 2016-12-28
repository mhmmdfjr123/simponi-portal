# Simponi Portal Installation for Development

## Prerequisite

### PHP

    * PHP >= 7
    * OpenSSL PHP Extension
    * PDO PHP Extension
    * Mbstring PHP Extension
    * Tokenizer PHP Extension
    * XML PHP Extension
    
> For DEVELOPMENT ONLY, you can use MAMP for Windows or MAMP for OSX

You can check your PHP version in console:

    php -v
    
### Oracle Driver for PHP

Since simponi portal uses oracle as database, you need to add PHP OCI8 driver Extension 
    
* [Setup OCI8 Driver in OSX](https://antistatique.net/fr/nous/bloggons/2013/03/25/install-php-oracle-oci-extension-11-2-on-mac-os-x-10-8) - Tested in macOS Sierra
* [Setup OCI8 Driver in RHEL/Centos/Fedora](http://antoine.hordez.fr/2012/09/30/howto-install-oracle-oci8-on-rhel-centos-fedora/) - Tested in Centos 6.5
    
### Composer

[Get composer](https://getcomposer.org/download/) for your machine
 
### NodeJS

[Install NodeJS](https://nodejs.org/en/) >=  v6.9.1

> Required for DEVELOPMENT ONLY

## How to Install

1. Open your terminal / console

2. Clone from repository: 

        git clone http://devtass:8880/simponi/simponi-portal.git
    
    And then change directory to `simponi-portal` project
    
        cd simponi-portal

3. Install Laravel Dependencies

        composer install
    
4. Create .env file based on .env.example, or you can try the following command:

        cp .env.example to .env

5. Install node modules

        npm install

6. Cihuyy.. you can run your project

        php artisan serve

Any question? send email to: efriandika.pratama@bni.co.id

## Author
1. [Efriandika Pratama](efriandika.pratama@bni.co.id)