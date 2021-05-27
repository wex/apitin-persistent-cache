# Apitin - persistent cache

```php
$cache = new Apitin\PersistentCache\PersistentCache();
$test = $cache->get('my.key', function() { return "foobar"; });
```