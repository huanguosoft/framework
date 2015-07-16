<?php namespace Agile\Foundation\Bootstrap;

use Dotnev;
use InvalidArgumentException;
use Agile\Foundation\Application;

class DetectEnvironment {

    public function bootstrap(Application $app) {
        try {
            Dotnev::load($app->basePath(), $app->environmentFile());
        } catch (InvalidArgumentException $e) {
            //
        }

        $app->detectEnvironment(function(){
            return env('APP_ENV', 'production');
        });
    }
}