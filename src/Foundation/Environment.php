<?php namespace Agile\Foundation;

use Closure;

class Environment {

    public function detect(Closure $callback, $consoleArgs = null) {
        if ($consoleArgs) {
            //
        }
        return $this->detectWebEnvironment($callback);
    }

    public function detectWebEnvironment(Closure $callback) {
        return call_user_func($callback);
    }
}