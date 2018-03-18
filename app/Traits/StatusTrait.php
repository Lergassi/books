<?php


namespace App\Traits;


trait StatusTrait
{
    private $status;

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