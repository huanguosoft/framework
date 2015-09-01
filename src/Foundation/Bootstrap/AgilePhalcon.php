<?php namespace Agile\Foundation\Bootstrap;

use Dotnev;
use InvalidArgumentException;
use Agile\Foundation\Application;

class AgilePhalcon {

    public function bootstrap(Application $app) {
        if ( extension_loaded('phalcon') ) {
            return 'Agile\Phalcon\Application';
        }

        return false;
    }
}