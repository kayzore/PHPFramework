<?php

namespace kayzore\bundle\ConfigurationBundle;


use Symfony\Component\Yaml\Yaml;

class KayParameters
{
    private $pathConfig = 'app/config/';
    private $pathErrorView  = 'src/kayzore/bundle/ServicesBundle/Ressources/Views/';

    public function __construct() {
        // PROJECT INFORMATIONS
        define('DIR_CONFIG', RACINE_WEB . $this->pathConfig);
        $config = Yaml::parse(file_get_contents(DIR_CONFIG . 'parameters.yml'));

        define('DIR_VIEW_ERROR', RACINE_WEB . $this->pathErrorView);
        // DATABASE INFORMATIONS
        define('DB_HOST', $config['parameter']['db_host']);
        define('DB_NAME', $config['parameter']['db_name']);
        define('DB_USER', $config['parameter']['db_user']);
        define('DB_PASS', $config['parameter']['db_pass']);
    }
}