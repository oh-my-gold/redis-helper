<?php

namespace OhMyGold\RedisHelper\RdbTrait;



/**
 * 字符串类型操作
 * @method \Redis init()
 * @see https://www.runoob.com/redis/redis-strings.html
 *
 * 已完善
 */
trait StringTrait
{

    /**
     * 获取指定 key 的值。
     * @return mixed
     */
    public function get()
    {
        return $this->init()->get($this->keyName);
    }

    /**
     * 返回 key 中字符串值的子字符
     *
     * @param  int  $start
     * @param  int  $end
     *
     * @return false|\Redis|string
     */
    public function getRange(int $start, int $end)
    {
        return $this->init()->getRange($this->keyName, $start, $end);
    }

    /**
     * 设置指定 key 的值。
     *
     * @param $data
     *
     * @return mixed
     */
    public function set($data)
    {
        if ($this->expireRange == -1) {
            return $this->init()->set($this->keyName, $data);
        }

        if (!is_array($this->expireRange)) {
            $expire = $this->expireRange;
        } else {
            $expire = random_int($this->expireRange[0], $this->expireRange[1]);
        }

        return $this->init()->setex($this->keyName, $expire, $data);
    }

    /**
     * 将给定 key 的值设为 value ，并返回 key 的旧值(old value)。
     * @param $data
     *
     * @return false|\Redis|string
     */
    public function getset($value)
    {
        $rs = $this->init()->getset($this->keyName, $value);
        $this->expire();
        return $rs;
    }

    /**
     * 获取所有(一个或多个)给定 key 的值。
     * @param ...$keys
     *
     * @return array|\Redis
     */
    public function mget(...$keys)
    {
        $keys = array_map(function ($item) {
            return $this->keyNamePre . $item;
        }, $keys);
        return $this->init()->mget($keys);
    }

    /**
     * 同时设置一个或多个 key-value 对。
     * @param  array  $key_values
     *
     * @return bool|\Redis
     */
    public function mset(array $key_values)
    {
        $new_key_values = [];
        foreach ($key_values as $key => $value){
            $new_key_values[$this->keyNamePre . $key] = $value;
        }
        return $this->init()->mset($new_key_values);
    }

    /**
     * 同时设置一个或多个 key-value 对，当且仅当所有给定 key 都不存在。
     * @param  array  $key_values
     *
     * @return bool|\Redis
     */
    public function msetnx(array $key_values)
    {
        $new_key_values = [];
        foreach ($key_values as $key => $value){
            $new_key_values[$this->keyNamePre . $key] = $value;
        }
        return $this->init()->msetnx($new_key_values);
    }

    /**
     * 这个命令和 SETEX 命令相似，但它以毫秒为单位设置 key 的生存时间，而不是像 SETEX 命令那样，以秒为单位。
     * @param  int  $milliseconds
     * @param $data
     *
     * @return bool|\Redis
     */
    public function psetex(int $milliseconds, $data)
    {
        return $this->init()->psetex($this->keyName, $milliseconds, $data);
    }

    /**
     * 只有在 key 不存在时设置 key 的值。
     * @param $data
     * @return mixed
     */
    public function setnx($data)
    {
        $res = $this->init()->setnx($this->keyName, $data);
        if ($res) {
            $this->expire();
        }

        return $res;
    }

    /**
     * 将值 value 关联到 key ，并将 key 的过期时间设为 seconds (以秒为单位)。
     * @param $data
     * @param  int  $expire
     *
     * @return bool|\Redis
     */
    public function setex($data, int $expire)
    {
        return $this->init()->setex($this->keyName, $expire, $data);
    }

    /**
     * 用 value 参数覆写给定 key 所储存的字符串值，从偏移量 offset 开始。
     * @param  int  $offset
     * @param  string  $value
     *
     * @return false|int|\Redis
     */
    public function setRange(int $offset, string $value)
    {
        $rs = $this->init()->setRange($this->keyName, $offset, $value);
        $this->expire();
        return $rs;
    }

    /**
     * 获取 key 中字符串值的长度。
     * @return false|int|\Redis
     */
    public function strlen()
    {
        return $this->init()->strlen($this->keyName);
    }

    /**
     * 将 key 中储存的数字值增一。
     * @param  int  $by
     *
     * @return false|int|\Redis
     */
    public function incr(int $by=1)
    {
        $rs = $this->init()->incr($this->keyName, $by);

        $this->expire();
        return $rs;
    }

    /**
     * 将 key 所储存的值加上给定的增量值（increment） 。
     *
     * @param  int  $increment
     *
     * @return mixed
     */
    public function incrby(int $increment = 1)
    {
        $rs = $this->init()->incrby($this->keyName, $increment);

        $this->expire();
        return $rs;
    }

    /**
     * 将 key 所储存的值加上给定的浮点增量值（increment） 。
     * @param  float  $value
     *
     * @return false|float|\Redis
     */
    public function incrbyfloat(float $value)
    {
        $rs = $this->init()->incrbyfloat($this->keyName, $value);

        $this->expire();
        return $rs;
    }

    /**
     * 将 key 中储存的数字值减一。
     * @param  int  $by
     *
     * @return false|int|\Redis
     */
    public function decr(int $by=1)
    {
        $rs = $this->init()->decr($this->keyName, $by);

        $this->expire();
        return $rs;
    }

    /**
     * 将 key 所储存的值减去给定的减量值（decrement） 。
     * @param  int  $decrement
     *
     * @return false|int|\Redis
     */
    public function decrby(int $decrement = 1)
    {
        $rs = $this->init()->decrby($this->keyName, $decrement);

        $this->expire();
        return $rs;
    }

    /**
     * 指定的 value 追加到该 key 原来值（value）的末尾。
     * @param  string  $value
     *
     * @return false|int|\Redis
     */
    public function append(string $value)
    {
        $rs = $this->init()->append($this->keyName, $value);

        $this->expire();
        return $rs;
    }
}