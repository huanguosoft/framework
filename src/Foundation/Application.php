<?php namespace Agile\Foundation;
/**
 * 框架主文件
 * 定义框架本身属性
 */

use Closure;

class Application {

    /**
     * The Agile PHP Framework Version.
     * Agile框架版本号
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * The base path for Agile installation.
     * Agile安装根目录.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The environment file to load during bootstrapping.
     * 在运行之前加载的环境变量文件名
     *
     * @var string
     */
    protected $environmentFile = '.env';

    public function __construct($basePath = null) {
        if ($basePath) $this->setBasePath($basePath);
    }

    /**
     * Get the version number of the application.
     * 获取版本号
     *
     * @return string
     */
    public function version() {
        return static::VERSION;
    }

    /**
     * Detect the application's current environment.
     * 检查当前的环境变量
     *
     * @param  \Closure $callback
     * @return string
     */
    public function detectEnvironment(Closure $callback) {
        $args = isset($_SERVER['args']) ? $_SERVER['args'] : null;

        return $this['env'] = (new Environment())->find($callback, $args);
    }

    /**
     * Set the base path for the application.
     * 设置根目录
     *
     * @param  string $basePath
     * @return $this
     */
    public function setBasePath($basePath) {
        $this->basePath = $basePath;

        return $this;
    }

}
