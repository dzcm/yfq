<?php

namespace Wechat\Lib;

use Wechat\Loader;

/**
 * SDK缓存类
 * 
 * @author Anyon <zoujingli@qq.com> 
 * @date 2016-08-20 17:50
 */
class Cache {

    /**
     * 缓存位置
     * @var type 
     */
    static public $cachepath;

    /**
     * 设置缓存
     * @param type $name
     * @param type $value
     * @param type $expired
     * @return type
     */
    static public function set($name, $value, $expired = 0) {
        if (isset(Loader::$callback['CacheSet'])) {
            return call_user_func_array(Loader::$callback['CacheSet'], func_get_args());
        }
        $data = serialize(array('value' => $value, 'expired' => $expired > 0 ? time() + $expired : 0));
        return self::check() && file_put_contents(self::$cachepath . $name, $data);
    }

    /**
     * 读取缓存
     * @param type $name
     * @return type
     */
    static public function get($name) {
        if (isset(Loader::$callback['CacheGet'])) {
            return call_user_func_array(Loader::$callback['CacheGet'], func_get_args());
        }
        if (self::check() && ($file = self::$cachepath . $name) && file_exists($file) && ($data = file_get_contents($file)) && !empty($data)) {
            $data = unserialize($data);
            if (isset($data['expired']) && ($data['expired'] > time() || $data['expired'] === 0)) {
                return isset($data['value']) ? $data['value'] : null;
            }
        }
        return null;
    }

    /**
     * 删除缓存
     * @param type $name
     * @return type
     */
    static public function del($name) {
        if (isset(Loader::$callback['CacheDel'])) {
            return call_user_func_array(Loader::$callback['CacheDel'], func_get_args());
        }
        return self::check() && unlink(self::$cachepath . $name);
    }

    /**
     * 输出内容到日志
     * @param type $line
     * @param type $filename
     * @return type
     */
    static public function put($line, $filename = '') {
        if (isset(Loader::$callback['CachePut'])) {
            return call_user_func_array(Loader::$callback['CachePut'], func_get_args());
        }
        empty($filename) && $filename = date('Ymd') . '.log';
        return self::check() && file_put_contents(self::$cachepath . $filename, '[' . date('Y/m/d H:i:s') . "] {$line}\n", FILE_APPEND);
    }

    /**
     * 检查缓存目录
     * @return boolean
     */
    static protected function check() {
        empty(self::$cachepath) && self::$cachepath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Cache' . DIRECTORY_SEPARATOR;
        self::$cachepath = rtrim(self::$cachepath, '/\\') . DIRECTORY_SEPARATOR;
        if (!is_dir(self::$cachepath) && !mkdir(self::$cachepath, 0755, TRUE)) {
            return FALSE;
        }
        return TRUE;
    }

}
