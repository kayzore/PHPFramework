<?php

namespace kayzore\bundle\ControllerBundle\Controller;

use app\AppKernel;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;

class Controller
{
    protected $twig;
    private $bundles;

    public function __construct($nameBundle) {
        $appKernel = new AppKernel();
        $registerBundles = $appKernel->registerBundles();
        foreach ($registerBundles as $name => $bundlePath) {
            $this->bundles[$name] = $bundlePath;
        }
        // Instanciation de Twig
        $loader = new Twig_Loader_Filesystem(
            $_SERVER['DOCUMENT_ROOT'] . RACINE_WEB . $this->bundles[$nameBundle] . 'Ressources\Views\\'
        );
        // Paramètres twig
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false/*__DIR__ . '/tmp'*/,
            'debug' => true,
        ));
        $this->twig->addExtension(new Twig_Extension_Debug());
    }
}