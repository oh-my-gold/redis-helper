<?php

namespace OhMyGold\RedisHelper;

use OhMyGold\RedisHelper\RdbTrait\HashTrait;
use OhMyGold\RedisHelper\RdbTrait\StringTrait;

/**
 * 使用案例
 *
 * 使用方法
 *
 * $hash = new DemoRdbModel('123');
 * $hash->hSet('a', 1111);
 * var_dump($hash->hGetAll());
 */
class DemoRdbModel extends BaseRdbModel
{
    /**
     * 连接配置
     * @var string|array
     */
    protected $connect = 'queue';

    /**
     * 必须
     * 引入类型 StringTrait/HashTrait/ListTrait/SetTrait/ZSetTrait
     */
    use HashTrait;

    /**
     * 键值名前缀 必须
     * @var string
     */
    protected $keyNamePre = 'Demo:';

    /**
     * 过期时间 必须
     * int 固定过期时间设定
     * [int, int] 范围时间内随机过期时间设定
     * @var int|int[]
     */
    protected $expireRange = 60*60*24*31;


    public function __construct($id)
    {
        parent::__construct($id);
    }
}