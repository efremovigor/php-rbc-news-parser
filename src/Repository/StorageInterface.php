<?php


namespace App\Repository;


interface StorageInterface
{
    public function save($data);

    public function get();
}