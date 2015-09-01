<?php namespace Agile\Phalcon;

use Agile\Foundation\Application as AgileApplication;
use Phalcon\Loader;

class Application extends AgileApplication {

    public function run() {
        $loader = new Loader();
        $loader->registerDirs(
            array(
                $this->path().'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR,
                $this->path().'Http'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR,
            )
        )->register();
        return $loader;
    }

}