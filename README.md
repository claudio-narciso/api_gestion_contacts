## Configuration Apache

### MODs à installer

- php
- php-mysql
- rewrite

### Configuration du virtual host

```
<VirtualHost *:80>
    ServerName ${serverName}
    DocumentRoot /var/www/${serverName}

    <Directory "/var/www/${serverName}">
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>

    RewriteEngine On
    RewriteCond %{REQUEST_URI} !\.(css|jpg)$
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [QSA,L]
</VirtualHost>
```

# Configuration de la base de données

Dans une base de données MySQL, jouer le script schema.sql. Vous pouvez modifier les premières lignes de ce script si
vous souhaitez modifier les identifiants de connexion à la base de données. Si vous le faites, pensez à modifier le
fichier Modele/DatabaseHandler pour y reporter vos modifications.
