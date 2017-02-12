<?php

namespace kayzore\bundle\ControllerBundle\Controller;

use app\AppKernel;
use kayzore\bundle\ServicesBundle\Model\ServiceException;
use Symfony\Component\Yaml\Yaml;
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
        // Instanciation des bundles
        foreach ($registerBundles as $name => $bundlePath) {
            $this->bundles[$name] = $bundlePath;
        }
        // Instanciation de Twig
        if (empty($this->bundles[$nameBundle])) {
            $errorMessage = "Aucun bundle portant le nom $nameBundle n'a été trouvé, "
                . "vérifier la délcaration dans l'AppKernel, ou le nom du bundle dans le controller";
             new ServiceException(404, $errorMessage);
        } else {
            $loader = new Twig_Loader_Filesystem(
                RACINE_WEB . $this->bundles[$nameBundle] . 'Ressources\Views\\'
            );
            // Paramètres twig
            $config = Yaml::parse(file_get_contents(DIR_CONFIG . 'config.yml'));
            $this->twig = new Twig_Environment($loader, $config['twig']);
            $this->twig->addExtension(new Twig_Extension_Debug());
        }
    }
}