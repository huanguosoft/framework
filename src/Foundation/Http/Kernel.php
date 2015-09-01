<?php namespace Agile\Foundation\Http;

class Kernel {

    protected $bootstrap = [
        'Agile\Foundation\Bootstrap\DetectEnvironment',
        'Agile\Foundation\Bootstrap\AgilePhalcon',
        'Agile\Foundation\Bootstrap\AgileYaf',
    ];
}