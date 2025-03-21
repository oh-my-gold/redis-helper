<?php

namespace OhMyGold\RedisHelper\RdbTrait;

/**
 * 集合类型操作
 * @method \Redis init()
 */
trait SetTrait
{
    public function sAdd($value)
    {
        $rs = $this->init()->sAdd($this->keyName, $value);
        $this->expire();
        return $rs;
    }


    public function sRandMember($cnt)
    {
        return $this->init()->sRandMember($this->keyName, $cnt);
    }

    public function sIsMember($value)
    {
        return $this->init()->sIsMember($this->keyName, $value);
    }


    public function sDiff($diffKey)
    {
        return $this->init()->sDiff($this->keyName, $diffKey);
    }

    public function sCard()
    {
        return $this->init()->sCard($this->keyName);
    }

    public function sPop()
    {
        return $this->init()->sPop($this->keyName);
    }

    public function sRem($member1, ...$members)
    {
        $rs = $this->init()->sRem($this->keyName, $member1, ...$members);

        $this->expire();
        return $rs;
    }

    public function sMembers()
    {
        return $this->init()->sMembers($this->keyName);
    }
}