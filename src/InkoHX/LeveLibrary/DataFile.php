<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/LeveLibrary
 */

namespace inkohx\LeveLibrary;


use pocketmine\utils\Config;

class DataFile
{
    /** @var string $path */
    private $path;

    /** @var Config $config */
    private $config;

    /**
     * DataFile constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->path = LevelAPI::getPath() . $file;
        @mkdir($this->path, 0755, true);
        $this->config = new Config($this->path . '/data.json', Config::JSON, [
            'level' => 1,
            'xp' => 0,
            'maxxp' => 50
        ]);
    }

    /**
     * @param string $key
     *
     * @return bool|mixed
     */
    public function get(string $key)
    {
        return $this->config->get($key);
    }

    /**
     * @param string $key
     *
     * @param bool|mixed $data
     */
    public function set(string $key, $data): void
    {
        $this->config->set($key, $data);
        $this->config->save();
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists(string $key): bool
    {
        return $this->config->exists($key);
    }
}