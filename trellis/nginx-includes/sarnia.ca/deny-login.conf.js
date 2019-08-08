{% if env == 'staging' -%}

location ~ (^/wp/wp-admin(?!/admin-ajax\.php)|^/wp/wp-login\.php) {
  try_files $uri $uri/ /index.php?$args;
  index index.html index.htm index.php;
  deny all;
  error_page 403 =404 /404;
}
{% endif -%}
