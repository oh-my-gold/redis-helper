<?php

namespace OhMyGold\RedisHelper\RdbTrait;

/**
 * HyperLogLog类型操作
 * @method \Redis init()
 * @protected string $keyNamePre
 * @protected string $keyName
 */
trait HyperLogLogTrait
{
    /**
     * @param  array  $elements
     *
     * @return true
     */
    public function pfAdd(array $elements)
    {
        $this->init()->pfAdd($this->keyName, $elements);
        $this->expire();
        return true;
    }

    /**
     * @param ...$name
     *
     * @return false|int|\Redis
     */
    public function pfCount(...$name)
    {
        if (empty($name)) {
            return $this->init()->pfCount($this->keyName);
        }

        $name = array_map(function ($item) {
            return $this->keyNamePre . $item;
        }, $name);

        return $this->init()->pfCount($name);
    }

    /**
     * @param  array  $sourceKeys
     *
     * @return true
     */
    public function pfMerge(array $sourceKeys)
    {
        $this->init()->pfMerge($this->keyName, $sourceKeys);
        $this->expire();
        return true;
    }
}