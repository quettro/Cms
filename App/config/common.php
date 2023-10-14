<?php

return [
    'nginx' => [
        '80-p' => <<<'EOT'
        server {
            listen 80;
            listen [::]:80;

            server_name {% server_name %};
            server_tokens off;

            root /var/www/html/public;

            index index.php;

            charset {% charset %};

            location / {
                try_files $uri $uri/ /index.php?$query_string;
            }

            location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass web:9000;
                fastcgi_index index.php;
                include fastcgi_params;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                fastcgi_param PATH_INFO $fastcgi_path_info;
            }
        }
        EOT,

        '443-p' => <<<'EOT'
        server {
            listen 80;
            listen [::]:80;

            server_name {% server_name %};

            return 301 https://$server_name$request_uri;
        }

        server {
            listen 443 ssl http2;
            listen [::]:443 ssl http2;

            server_name {% server_name %};
            server_tokens off;

            root /var/www/html/public;

            index index.php;

            charset {% charset %};

            ssl_certificate {% ssl_certificate %};
            ssl_certificate_key {% ssl_certificate_key %};

            ssl_protocols TLSv1.2;
            ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-SHA384;
            ssl_prefer_server_ciphers on;

            add_header X-Frame-Options "SAMEORIGIN";
            add_header X-XSS-Protection "1; mode=block";
            add_header X-Content-Type-Options "nosniff";

            location / {
                try_files $uri $uri/ /index.php?$query_string;
            }

            location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass web:9000;
                fastcgi_index index.php;
                include fastcgi_params;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                fastcgi_param PATH_INFO $fastcgi_path_info;
            }
        }
        EOT,
    ],
];
