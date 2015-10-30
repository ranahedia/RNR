Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "/var/www/html/RNR/public"
   ServerName RNR.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "/var/www/html/RNR/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>
