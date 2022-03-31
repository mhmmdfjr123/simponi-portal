# Simponi Portal Installation for Development - Vagrant

What is Vagrant? [click here](https://www.vagrantup.com/). Vagrant can be used in Windows, macOS, and Linux.

> Vagrant is a tool for building complete DEVELOPMENT ENVIRONMENTS. With an easy-to-use workflow and focus on automation, Vagrant lowers development environment setup time, increases development/production parity, and makes the "works on my machine" excuse a relic of the past.

If you wanna develop without vagrant, [click here](installation.md)

## Prerequisite

### Install VirtualBox

Since Vagrant needs virtualbox, you have to [Download](https://www.vagrantup.com/downloads.html) and Install VirtualBox in your machine

### Install Vagrant

[Download](https://www.vagrantup.com/downloads.html) and Install vagrant
    
### Configure vagrant behind proxy:

Open your terminal / console, run this command:

    # Change with your proxy configuration
    export http_proxy=192.168.46.90:8080
    export https_proxy=192.168.46.90:8080
    
Install Vagrant Proxy Conf

    vagrant plugin install vagrant-proxyconf
    
## How to Install

1. Open your terminal / console

2. Clone from repository: 

        git clone http://devtass:8880/simponi/simponi-portal.git
    
    And then change directory to `simponi-portal` project
    
        cd simponi-portal

3. Copy Homestead configuration from `<project root>/vagrant/Homestead.yaml.example` to `<project root>/Homestead.yaml`
   Then, setup project folders map path. For Example:
   
        # DON'T FORGET TO SETUP FOLDER MAP
        # EXAMPLE:
        #       FOR WINDOWS     -> C:/Some_dir/some_dir_again/project
        #       FOR Mac / Linux -> /Some_dir/some_dir_again/project
        folders:
            - map: "/Users/efriandika/P/PHP/simponi-portal" # Paste your project path to this line
              to: "/home/vagrant/simponi-portal"
             
4. Edit `/etc/hosts` file:

        192.168.10.10	simponi.app
        
    If you work behind the proxy, add `simponi.app` to exception list.

5. Run Vagrant

        vagrant up
       
    Useful command:
   
        # To destroy vagrant, it will reset vagrant box configuration
        vagrant destroy --force
       
        # To turn off your vagrant machine. It will NOT reset your vagrant box
        vagrant halt
       
        # To Run vagrant.
        vagrant up

6. Login to your vagrant

        vagrant ssh
       
    Change directory to your project (shared directory)
   
        cd simponi-portal

7. Install Laravel Dependencies

        composer install
    
8. Create .env file based on .env.example, or you can try the following command:

        cp .env.example .env

9. Install node modules

        npm install
        
   If you are developing on a Windows system or you are running your VM on a Windows host system, you may need to run the `npm install` command with the `--no-bin-links` switch enabled:
    
        npm install --no-bin-links

10. Cihuyy.. you can access your project from browser `http://simponi.app`


Any question? send email to: efriandika.pratama@bni.co.id

## Author
1. [Efriandika Pratama](efriandika.pratama@bni.co.id)