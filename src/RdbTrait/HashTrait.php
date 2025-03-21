<?php

namespace OhMyGold\RedisHelper\RdbTrait;

/**
 * 哈希类型操作
 * @method \Redis init()
 */
trait HashTrait
{

    public function __get($name)
    {
        return $this->init()->hGet($this->keyName, $name);
    }

    public function __set($name, $value)
    {
        $this->init()->hSet($this->keyName, $name, $value);
        $this->expire();
    }

    public function __isset($name)
    {
        return $this->init()->hExists($this->keyName, $name);
    }

    /**
     * @param $member
     *
     * @return array|false|\Redis
     */
    public function hGet($member)
    {
        return $this->init()->hGet($this->keyName, $member);
    }

    public function hGetAll()
    {
        return $this->init()->hGetAll($this->keyName);
    }

    /**
     * @param  array  $fields
     *
     * @return array
     */
    public function hMget(array $fields):array
    {
        return $this->init()->hMget($this->keyName, $fields);
    }


    /**
     * 设置值
     * @param $member
     * @param $value
     *
     * @return true
     */
    public function hSet($member, $value)
    {
        $this->init()->hSet($this->keyName, $member, $value);
        $this->expire();
        return true;
    }

    /**
     * 批量设置值
     * @param [string, string] $fvData
     *
     * @return true
     */
    public function hMset($fvData)
    {
        $this->init()->hMset($this->keyName, $fvData);
        $this->expire();
        return true;
    }


    /**
     * @param string $field
     * @param int $increment
     *
     * @return false|int|\Redis
     */
    public function hincrby($field, $increment)
    {
        $rs = $this->init()->hincrby($this->keyName, $field, $increment);
        $this->expire();
        return $rs;
    }

    /**
     * @param string $field
     * @param float $increment
     *
     * @return false|float|\Redis
     */
    public function hincrbyfloat($field, $increment)
    {
        $rs = $this->init()->hincrbyfloat($this->keyName, $field, $increment);
        $this->expire();
        return $rs;
    }


    public function hDel($field = '')
    {
        $this->expire();
        return $this->init()->hDel($this->keyName, $field);
    }


    public function hExists($field)
    {
        return $this->init()->hExists($this->keyName, $field);
    }
}