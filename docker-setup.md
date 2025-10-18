# Docker Setup Notes

## Direct running commands

```bash
docker run -d --add-host=host.docker.internal:172.0.0.1 -p 9000:9000 -v /home/hariharan/open-workspace/tamil-pulavar/www.tamilpulavar.org:/home/hariharan/open-workspace/tamil-pulavar/www.tamilpulavar.org/ php-fpm-mysqli
```

## Docker Compose

```bash
# to start container services
docker compose up
# to stop container services
docker compose down
```

## Database Setup related

- Makesure if you are connecting the same system database from docker container is the database connection accessible from the container

```sql
DROP USER 'db_user'@'%';
CREATE USER 'db_user'@'%' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON database.* TO 'db_user'@'%';
FLUSH PRIVILEGES;
```

## Apache Configuration - for enabling proxy,fcgi

### modules enabling and verifying

```conf

```

### Virtual host setup to access application in host machine

```conf
<VirtualHost *:80>
    ServerName domain
    DocumentRoot /var/www/{domain}/html
    <Directory /var/www/{domain}/html>
        Options +FollowSymLinks -MultiViews +Indexes
	    AllowOverride All
        Require all granted
    </Directory>

    # Use FastCGI proxy handler
    <FilesMatch "\.php$">
        SetHandler "proxy:fcgi://127.0.0.1:9000"
    </FilesMatch>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
