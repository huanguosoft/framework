<?php namespace Agile\Foundation;
/**
 * 框架主文件
 * 定义框架本身属性
 */

use Closure;
use Agile\Container\Container;

class Application extends Container {

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

    /**
     * @var
     */
    protected $storagePath;

    /**
     * Initialize application
     * 初始化应用
     *
     * @param string $basePath
     */
    public function __construct($basePath = null) {
        // 准备目录结构
        if ($basePath) $this->setBasePath($basePath);
    }

    /**
     * Run application
     * 运行应用
     *
     * @return void
     */
    public function run() {
        return $this;
    }

    /**
     * Get the version number of the application.
     * 获取版本号
     *
     * @return string
     */
    public function version() {
        return self::VERSION;
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

        $this->bindPathsInContainer();

        return $this;
    }

    protected function bindPathsInContainer() {
        $this->instance('path', $this->path());

        foreach (['base', 'config', 'lang', 'public', 'storage'] as $path) {
            $this->instance('path.'.$path, $this->{$path.'Path'}());
        }
    }

    public function path() {
        return $this->basePath.'app'.DIRECTORY_SEPARATOR;
    }

    /**
     * Get The base path for application
     * 获取应用跟目录
     *
     * @return string
     */
    public function basePath() {
        return $this->basePath;
    }

    /**
     * Get the path to the application configuration files.
     * 获取应用配置文件路径
     *
     * @return string
     */
    public function configPath() {
        return $this->basePath.'config'.DIRECTORY_SEPARATOR;
    }

    /**
     * Get the path to the language files.
     * 获取应用语言包路径
     *
     * @return string
     */
    public function langPath() {
        return $this->basePath.'resources'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR;
    }

    /**
     * Get the path to the public / web directory.
     * 获取应用web访问资源路径
     *
     * @return string
     */
    public function publicPath() {
        return $this->basePath.'public'.DIRECTORY_SEPARATOR;
    }

    /**
     * Get the path to the storage directory.
     * 获取文件可读写路径，用于生成日志，缓存等
     *
     * @return string
     */
    public function storagePath() {
        return $this->storagePath ?: $this->basePath.'storage'.DIRECTORY_SEPARATOR;
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

        return $this['env'] = (new Environment())->detect($callback, $args);
    }

    /**
     * Get the environment file name
     * 获取环境变量文件名
     *
     * @return string
     */
    public function environmentFile() {
        return $this->environmentFile ?: '.env';
    }

}
