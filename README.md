# REDIS使用规范

## 规范
1. 统一模块管理,方便追踪与重构

## 用法

1. 继承基类 [BaseRdbModel.php](BaseRdbModel.php)

```php
class TestRdbModel extends BaseRdbModel{}
```

2. 引入相应REDIS类型特征，如HASH类型
   [HashTrait.php](RdbTrait/HashTrait.php)
```php

class TestRdbModel extends BaseRdbModel{
    use RdbTrait\HashTrait;
}
```

3. 设置必要参数

```php
class TestRdbModel extends BaseRdbModel{

    /**
     * 连接配置
     * @var string|array
     */
    protected $connect = 'queue';
    
    /**
     * 键值名前缀 必须
     * @var string
     */
    protected $keyNamePre = 'Demo:TestHash:';

    /**
     * 过期时间 必须
     * int 固定过期时间设定
     * [int, int] 范围时间内随机过期时间设定
     * @var int|int[]
     */
    protected $expireRange = 60;


    use RdbTrait\HashTrait;
}
```

4. 使用
在需要的地方直接调用即可,IDEA会自动提示，如下
```php
$rdb_model = new TestRdbModel();
$rdb_model->hSet('key', 'value');
$rdb_model->hGet('key');
$rdb_model->hDel('key');
$rdb_model->hGetAll('key');
```

