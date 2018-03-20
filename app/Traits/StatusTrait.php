<?php


namespace App\Traits;

/**
 * @property int $status - Поле в таблице.
 */
trait StatusTrait
{
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isStatus(int $status)
    {
        return $this->status == $status;
    }
}