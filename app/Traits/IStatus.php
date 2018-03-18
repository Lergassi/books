<?php


namespace App\Traits;


interface IStatus
{
    public function setStatus(int $status);
    public function getStatus();
    public function isStatus(int $status);
    public static function getStatusLabels(): array;
}