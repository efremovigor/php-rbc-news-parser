<?php


namespace App\Repository;

use Kluatr\DynamicServices\Components\TmpFileManager;

class RbcStorage extends TmpFileManager implements StorageInterface
{
    private const FILENAME = 'rbknews.csv';

    public function getPath(): string
    {
        return 'storage/';
    }

    public function save($data)
    {
        $fileData = $this->read(static::FILENAME);
        $this->rewrite(static::FILENAME, $data . $fileData);
    }

    public function get()
    {
        return $this->read(static::FILENAME);
    }
}