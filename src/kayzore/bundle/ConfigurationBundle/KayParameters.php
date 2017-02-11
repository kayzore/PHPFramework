<?php

namespace kayzore\bundle\ConfigurationBundle;


use Symfony\Component\Yaml\Yaml;

class KayParameters
{
    private $pathConfig = 'app/config/';
    private $pathErrorView  = 'src/kayzore/bundle/ErrorBundle/';

    public function __construct() {
        // PROJECT INFORMATIONS
        define('RACINE_WEB', '/PHPFramework/');
        define('DIR_VIEW_ERROR', $_SERVER['DOCUMENT_ROOT'] . RACINE_WEB . $this->pathErrorView);
        define('DIR_CONFIG', $_SERVER['DOCUMENT_ROOT'] . RACINE_WEB . $this->pathConfig);
        $config = Yaml::parse(file_get_contents(DIR_CONFIG . 'parameters.yml'));
        // DATABASE INFORMATIONS
        define('DB_HOST', $config['parameter']['db_host']);
        define('DB_NAME', $config['parameter']['db_name']);
        define('DB_USER', $config['parameter']['db_user']);
        define('DB_PASS', $config['parameter']['db_pass']);
    }
}