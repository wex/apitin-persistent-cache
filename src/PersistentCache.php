<?php declare(strict_types = 1);

namespace Apitin\PersistentCache;

use Closure;

class PersistentCache
{
    protected $redis;

    public function __construct($redisDsn = 'tcp://127.0.0.1:6379')
    {
        $this->redis = new \Predis\Client($redisDsn);
    }

    public function has(string $key): bool
    {
        return !!$this->redis->exists($key);
    }

    public function get(string $key, Closure $warm)
    {
        if (!$this->has($key)) {

            $this->set($key, $warm());

        }

        return $this->redis->get($key) ?? null;
    }

    public function set(string $key, $value): void
    {
        $this->redis->set($key, $value);
    }
}