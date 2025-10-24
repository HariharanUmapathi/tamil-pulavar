# ABOUT

This is the sourcecode for tamilpulavar.kaniyam.ca

## SETUP

Prerequisites:

- PHP V8.3.14
- mariadb
- composer

```bash
# clone repository
git clone https://github.com/HariharanUmapathi/tamil-pulavar.git

cd tamil-pulavar/www.tamilpulavar.org 

#on first time installation dotenv package required to get environment variables
composer install  

mv .env.sample .env
# update environment variables according to your environment

```

## DB setup

Download the db dump file from https://archive.org/download/tamilpulavar.db.sql.tar.gz/tamilpulavar.db.sql.tar.gz

Extract the compressed sql file tamilpulavar.db.sql.tar.gz

The extracted file will be around 950 MB.

Import the sql file into a mysql db.

## Contact

Ramasamy Duraipandy

ramsdurai@gmail.com

Maintainer

Hariharan Umapathi

# License
GNU GPL V3
