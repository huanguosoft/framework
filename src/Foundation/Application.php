<?php namespace Agile\Foundation;

/**
 * 框架主文件
 * 定义框架本身属性
 */

class Application {

    /**
     * The Agile PHP Framework Version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * The environment file to load during bootstrapping.
     *
     * @var string
     */
    protected $environmentFile = '.env';

    /**
     * 获取Agile框架版本
     * @return string
     */
    public function version() {
        return static::VERSION;
    }
}