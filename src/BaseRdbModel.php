<?php

namespace OhMyGold\RedisHelper;


use Illuminate\Support\Facades\Redis;

abstract class BaseRdbModel
{
    /**
     * 连接配置
     * @var string|array
     */
    protected $connect = '';

    /**
     * ID
     *
     * @var string
     */
    protected $id;

    /**
     * 对象Key前缀
     *
     * @var string
     */
    protected string $keyNamePre;

    /**
     * Redis对象key值
     *
     * @var string
     */
    protected string $keyName;

    /**
     * @var
     */
    protected $data;

    /**
     * 2~3天
     *
     * @var float[]|int[]|int
     */
    protected $expireRange = [86400 * 2, 86400 * 3];

    /**
     * @param mixed $id
     */
    public function __construct($id = '')
    {
        $this->id = $id;
        $this->keyName = $this->keyNamePre . $id;
    }

    /**
     * @param $connect
     *
     * @return \Redis
     */
    public function init($connect = null)
    {
        if(is_string($connect)) {
            $redis = Redis::connection($connect);
        } else {
            $redis = Redis::connection($connect);
        }

        return $redis;
    }


    /**
     * @return string
     */
    public function getKeyNamePre()
    {
        return $this->keyNamePre;
    }

    /**
     * @return string
     */
    public function getKeyName()
    {
        return $this->keyName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function expire()
    {
        if ($this->expireRange == -1) {
            return true;
        }

        if (!is_array($this->expireRange)) {
            $expireTime = $this->expireRange;
        } else {
            $expireTime = mt_rand($this->expireRange[0], $this->expireRange[1]);
        }
        return $this->init()->expire($this->keyName, $expireTime);
    }

    /**
     * @param $time
     * @return mixed
     */
    public function expireTime($time)
    {
        return $this->init()->expire($this->keyName, $time);
    }

    /**
     * 是否存在
     *
     * @return bool
     */
    public function exists()
    {
        return $this->init()->exists($this->keyName);
    }

    /**
     * 删除
     *
     * @return mixed
     */
    public function del()
    {
        return $this->init()->del($this->keyName);
    }

}
