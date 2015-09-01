<?php namespace Agile\Foundation\Bootstrap;

use Dotnev;
use InvalidArgumentException;
use Agile\Foundation\Application;

class AgileYaf {

    public function bootstrap(Application $app) {
        if ( extension_loaded('yaf') ) {
            return 'Agile\Yaf\Application';
        }

        return false;
    }
}