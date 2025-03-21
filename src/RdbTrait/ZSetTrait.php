<?php

namespace OhMyGold\RedisHelper\RdbTrait;

/**
 * 有序集合类型操作
 * @method \Redis init()
 */
trait ZSetTrait
{
    /**
     * @param $value
     * @param $name
     *
     * @return mixed
     * @throws \Exception
     */
    public function zAdd($value, $name)
    {
        $rs = $this->init()->zAdd($this->keyName, $value, $name);

        $this->expire();
        return $rs;
    }

    /**
     * 计算在有序集合中指定区间分数的成员数
     *
     * @param $min
     * @param $max
     * @return mixed
     */
    public function zCount($min, $max)
    {
        $rs = $this->init()->zCount($this->keyName, $min, $max);
        return $rs;
    }


    /**
     * 对指定元素索引值的增减,改变元素排列次序
     *
     * @param $value
     * @param $name
     * @return mixed
     * @throws RdbModelException
     */
    public function zIncrBy($value, $name)
    {
        $rs = $this->init()->zIncrBy($this->keyName, $value, $name);
        $this->expire();
        return $rs;
    }


    /**
     * 从大到小排序
     *
     * @param $page
     * @param $pageSize
     * @param false $withscores
     * @return mixed
     */
    public function zRevRange($page, $pageSize, $withscores = false)
    {
        $start = ($page - 1) * $pageSize;
        $end = $start + $pageSize - 1;
        return $this->init()->zRevRange($this->keyName, $start, $end, $withscores);
    }

    /**
     * 获取某个成员的值
     *
     * @param $name
     * @return mixed
     */
    public function zScore($name)
    {
        return $this->init()->zScore($this->keyName, $name);
    }

    /**
     * 移除有序集合中的一个或多个成员
     * @param $name
     *
     * @return false|int|\Redis
     */
    public function zRem($name)
    {
        return $this->init()->zRem($this->keyName, $name);
    }

    /**
     * 判断是否存在某个成员
     *
     * @param $name
     * @return bool
     */
    public function checkExists($name)
    {
        return $this->init()->zScore($this->keyName, $name) !== false;
    }

    /**
     * 在计算有序集合中指定字典区间内成员数量
     * @param $name
     *
     * @return false|int|\Redis
     */
    public function zLexCount($name)
    {
        return $this->init()->zLexCount($this->keyName, '[' . $name, '[' . $name);
    }

    /**
     * 移除有序集合中给定的分数区间的所有成员
     * @param $min
     * @param $max
     *
     * @return false|int|\Redis
     */
    public function zRemRangeByScore($min, $max)
    {
        return $this->init()->zRemRangeByScore($this->keyName, $min, $max);
    }

    /**
     * 计算集合中元素的数量
     * @return false|int|\Redis
     */
    public function zCard()
    {
        return $this->init()->zCard($this->keyName);
    }

    /**
     * 返回有序集中，指定区间内的成员，从小到大
     * @param $start
     * @param $stop
     * @param $withScores
     *
     * @return array|false|\Redis
     */
    public function zRange($start, $stop, $withScores = false)
    {
        return $this->init()->zrange($this->keyName, $start, $stop, $withScores);
    }

    /**
     * 返回有序集中指定分数区间内的所有的成员。有序集成员按分数值递减(从大到小)的次序排列。
     * @param $max
     * @param $min
     * @param $limit
     *
     * @return array|false|\Redis
     */
    public function zRevRangeByScore($max, $min, $limit)
    {
        return $this->init()->zRevRangeByScore($this->keyName, $max, $min, $limit);
    }
}