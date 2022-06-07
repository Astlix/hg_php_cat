<?php
            $dominio = $_SERVER['HTTP_HOST'];
            // $directorio =  $_SERVER['REQUEST_URI'];
            $directorio =  '/hg_php_cat/';
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
            $url = $protocol . $dominio . $directorio;
            define( 'SERVERURL', $url );
            define( 'TITULO', 'SISTEMA CAT');
            define('METHOD','AES-256-CBC');
	        define('SECRET_KEY','$CATERPILLAR@2022');
	        define('SECRET_IV','101712');
