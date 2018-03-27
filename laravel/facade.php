<?php
class Facade
{
    public static function __callStatic($method, $args)
    {
        $instance = static::getInstance(static::getFacadeAccessor());
        return $instance->$method($args);
    }

    public static function getInstance($className)
    {
        return new $className;
    }
}

//Cache的具体实现
class RedisStorage
{
    public function get()
    {
        echo 'Redis';
    }
}

//Cache的具体实现
class MemcacheStorage
{
    public function get()
    {
        echo 'Memcache';
    }
}

//这里决定使用哪个具体实现
class Cache extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'MemcacheStorage';
    }
}

/**
 * 静态调用 get() 方法时, Cache 类中没有该静态方法, 此时调用继承自 Facade 类的魔术方法 __callStatic()
 * __callStatic() 方法中又使用了 static::getFacadeAccessor() 静态延迟绑定调用了 Cache 类的 getFacadeAccessor() 方法得到 MemcacheStorage 类名
 * 然后交由 Facade 类的 getInstance 方法进行实例化
 **/
Cache::get();
