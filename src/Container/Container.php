<?php namespace Agile\Container;

use ArrayAccess;

class Container implements ArrayAccess {
    /**
     * @var array
     */
    protected $alias = [];

    /**
     * @param $abstract
     * @param $alias
     */
    public function alias($abstract, $alias) {
        $this->alias[$abstract] = $alias;
    }

    public function instance($abstract, $instance) {
        // 如果是数组，则循环获取
        if (is_array($abstract)) {
            list($abstract, $alias) = $this->extractAlias($abstract);

            $this->alias($abstract, $alias);
        }

        unset($this->alias[$abstract]);

        $this->alias($abstract, $instance);
    }

    /**
     * Extract the type and alias from a given definition.
     * 从获取的数组参数中解压type和alias
     *
     * @param  array  $definition
     * @return array
     */
    protected function extractAlias(array $definition) {
        return [key($definition), current($definition)];
    }


    /**
     * Determine if a given offset exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function offsetExists($key) {
        return isset($this->alias[$key]);
    }

    /**
     * Get the value at a given offset.
     *
     * @param  string  $key
     * @return mixed
     */
    public function offsetGet($key) {
        return $this->make($key);
    }

    /**
     * Set the value at a given offset.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function offsetSet($key, $value) {
        // If the value is not a Closure, we will make it one. This simply gives
        // more "drop-in" replacement functionality for the Pimple which this
        // container's simplest functions are base modeled and built after.
        if ( ! $value instanceof Closure)
        {
            $value = function() use ($value)
            {
                return $value;
            };
        }

        $this->bind($key, $value);
    }

    /**
     * Unset the value at a given offset.
     *
     * @param  string  $key
     * @return void
     */
    public function offsetUnset($key) {
        unset($this->alias[$key]);
    }

    /**
     * Dynamically access container services.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key) {
        return $this[$key];
    }

    /**
     * Dynamically set container services.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value) {
        $this[$key] = $value;
    }

}
