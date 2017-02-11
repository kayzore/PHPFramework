<?php

namespace kayzore\bundle\ServicesBundle\Controller;


use app\AppKernel;
use kayzore\bundle\ServicesBundle\Model\ServiceException;

class Services
{
    private $service;

    public function __construct() {
        $appKernel = new AppKernel();
        $registerServices = $appKernel->registerService();
        // Instanciation des services
        if (empty($registerServices)) {
            $this->service = array();
        } else {
            foreach ($registerServices as $name => $service) {
                $this->service[$name] = $service;
            }
        }
    }

    public function getService($name) {
        if (array_key_exists($name, $this->service)) {
            return $this->service[$name];
        }
        $errorMessage = "Aucun service portant le nom $name n'a été trouvé, "
            . "vérifier la délcaration dans l'AppKernel, ou l'appel du service";
        return new ServiceException(404, $errorMessage);
    }
}