<?php

namespace OhMyGold\RedisHelper\RdbTrait;

/**
 * 列表类型操作
 * @method \Redis init()
 */
trait ListTrait
{

    /**
     * 移出并获取列表的第N个元素
     * @param  int  $count
     *
     * @return string|array
     */
    public function lPop(int $count = 1): string
    {
        return $this->init()->lPop($this->keyName, $count);
    }

    /**
     * 移除列表的最后N个元素，返回值为移除的元素。
     *
     * @param  int  $count
     *
     * @return string|array
     */
    public function rPop(int $count = 1): string
    {
        return $this->init()->rPop($this->keyName, $count);
    }

    /**
     * 将一个或多个值插入到列表头部
     * @param mixed ...$values
     * @return bool|int
     */
    public function lPush(...$values)
    {
        $data = [];
        foreach ($values as $value) {
            if (is_array($value)) {
                array_push($data, ...$value);
            } else {
                array_push($data, $value);
            }
        }

        return $this->init()->lPush($this->keyName, ...$data);
    }

    /**
     * 将一个值插入到已存在的列表头部
     *
     * @param $value
     *
     * @return bool|int
     */
    public function lPushx($value)
    {
        return $this->init()->lPushx($this->keyName, $value);
    }

    /**
     * 在列表尾部中添加一个或多个值
     * @param mixed ...$values
     * @return bool|int
     */
    public function rPush(...$values)
    {
        $data = [];
        foreach ($values as $value) {
            if (is_array($value)) {
                array_push($data, ...$value);
            } else {
                array_push($data, $value);
            }
        }

        return $this->init()->rPush($this->keyName, ...$data);
    }

    /**
     * 在已存在的列表尾部中添加一个值
     * @param $value
     *
     * @return mixed
     */
    public function rPushx($value)
    {
        return $this->init()->rPushx($this->keyName, $value);
    }
    
}