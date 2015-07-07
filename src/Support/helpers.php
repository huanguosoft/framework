<?php

if ( ! function_exists('value') ) {
    /**
     * 返回要获取值的默认值
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function value($value) {
        return $value instanceof Closure ? $value() : $value;
    }
}