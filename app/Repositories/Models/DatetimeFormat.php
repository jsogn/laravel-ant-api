<?php
namespace App\Repositories\Models;

use DateTimeInterface;

trait DatetimeFormat
{
    /**
    * 为数组 / JSON 序列化准备日期。
    *
    * @param  \DateTimeInterface  $date
    * @return string
    */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
