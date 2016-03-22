<?php

namespace TravelBlog;

use Behat\Transliterator\Transliterator;
use Yaoi\Service;

class FileStorage extends Service
{
    public $savedFiles = array();

    public function hardSave($directory, $path) {
        $basePath = rtrim($this->settings->path, '/') . '/' . Transliterator::urlize($directory);
        $baseUrl = rtrim($this->settings->urlRoot, '/') . '/' . Transliterator::urlize($directory);
        if (!file_exists($basePath)) {
            mkdir($basePath, 0755, true);
        }

        $savePath = realpath($basePath . '/' . basename($path));
        $saveUrl = $baseUrl . '/' . basename($path);

        if (rename($path, $savePath)) {
            $this->savedFiles [$savePath]= $saveUrl;
            return true;
        }
        return false;
    }
}