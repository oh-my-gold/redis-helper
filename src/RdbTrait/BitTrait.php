<?php

namespace OhMyGold\RedisHelper\RdbTrait;

/**
 * 位图类型操作
 * @method \Redis init()
 */
trait BitTrait
{

    /**
     * 计算字符串中的设置位数
     * @param  int  $start
     * @param  int  $end
     * @param  bool  $bybit
     *
     * @return false|int|\Redis
     * 时间复杂度： O（N）
     */
    public function bitCount(int $start = 0, int $end = -1, bool $bybit = false)
    {
        return $this->init()->bitCount($this->keyName, $start, $end, $bybit);
    }

    /**
     * @param  string  $operation
     * @param  string  $deskey
     * @param  string  $srckey
     * @param  string  ...$other_keys
     *
     * @return false|int|\Redis
     * todo: 等待补充
     */
    public function bitOp(string $operation, string $deskey, string $srckey, string ...$other_keys)
    {
        return $this->init()->bitOp($operation, $deskey, $srckey, ...$other_keys);
    }

    /**
     * @param  bool  $bit
     * @param  int  $start
     * @param  int  $end
     *
     * @return false|int|\Redis
     *
     * 时间复杂度： O（N）
     */
    public function bitPos(bool $bit, int $start = 0, int $end = -1)
    {
        return $this->init()->bitPos($this->keyName, $bit, $start, $end);
    }

    /**
     * 对 key 所储存的字符串值，设置或清除指定偏移量上的位(bit)。
     *
     * @param  int  $offset
     * @param  bool  $value
     *
     * @return false|int|\Redis
     */
    public function setBit(int $offset, bool $value = true)
    {
        return $this->init()->setBit($this->keyName, $offset, $value);
    }

    /**
     * 对 key 所储存的字符串值，获取指定偏移量上的位(bit)。
     *
     * @param  int  $offset
     *
     * @return false|int|\Redis
     */
    public function getBit(int $offset)
    {
        return $this->init()->getBit($this->keyName, $offset);
    }
}