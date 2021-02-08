---
title: Configuration Closures
featured_image_url: https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&w=1600
featured_image_text: Photo by [Luca Bravo](https://unsplash.com/@lucabravo?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
tags: ['Code', 'PHP']
published: 2021-02-06 08:56:42
---

<excerpt>
Nearly every application in existence requires some form of configuration. After
all, no two instances of the same app are exactly the same. The "tried and true"
(read "quick and dirty") way of doing this has conventionally been with arrays.
This works well for most basic configuration values of scalar types, however,
sometimes it may be necessary to configure complex objects.
</excerpt>

## An Example

A common example of complex object configuration is when configuring application
caching or queuing. Enabling these features will often require a [Redis][redis]
or [Memcached][memcached] server for storing your cached items or queued jobs. In 
PHP this is accomplished via a `Redis` or `Memcached` object.

Let's take a look at a typical Redis server configuration. First, the
configuration file.

```php
'redis_config' => [
    'host' => env('REDIS_HOST', '127.0.0.1'),
    'port' => env('REDIS_PORT', 6379),
    'password' => env('REDIS_PASSWORD'),
    // Many more possible options...
]
```

Then in the application code...

```php
// Instantiate a new Redis instance
$redis = new Redis;

// Retrieve the array from the config
$redisConfig = $config['redis_config'];

// Configure the Redis object
$redis->pconnect($redisConfig['host'], $redisConfig['port']);
$redis->auth($redisConfig['password']);
// And so on for every defined option...

// Use the configured object
$redis->set($key, $value, $expiration);
$redis->get($key);
```

This is fine if users only ever needs to configure a few options. However, when
the specific options a user will require is unknown ahead of time the only way
to _guarantee_ compatibility is to pre-define every possible option. This would
be excessively verbose, especially when most users will only configure a few
options. Additionally, if the available Redis configuration options were to ever
change the configuration options would need to be updated to reflect those
changes.

<div class="note">
    In this context "user" refers to the person configuring the application.
</div>

## A Better Approach

When configuration of a complex object (e.g. `Memcached`, `Redis`, etc.) is
required use a "configuration closure" instead of defining a list of individual
configuration options. Let's see how this works in practice.

First, in the configuration file add an entry with a [closure][closure-docs] as
its value. This closure should accept an instance of our complex object and may
contain some sane defaults in the body of the closure.

```php
'redis_config' => function (Redis $redis): void {
    // User configures the Redis object here
    $redis->pconnect('localhost', 6379);
    $redis->auth(env('REDIS_PASSWORD'));
    // Any additional configuration...
}
```

This gives the user _direct access_ to the actual `Redis` object we'll be using
in the application. They can then configure that object however they require
without us needing to clutter the configuration with several unused options.

Next, in the application code we resolve the closure from the config, execute it
and use the configured object normally.

```php
// Retrieve the closure from the config
$redisConfig = $config['redis_config'];

// Execute the closure to configure the object
$redisConfig($redis = new Redis);

// Use the configured object
$redis->set($key, $value, $expiration);
$redis->get($key);
```

In summary, configuration closures give the end-user full control of the 
configuration of complex objects, eliminates the need to pre-define options, 
future proofs our configuration, requires less code and (bonus) is type safe!

---

For more information about closures check out the [official docs][closure-docs]
or [PHP The Right Way][php-the-right-way].

[redis]: https://github.com/phpredis/phpredis#classes-and-methods
[memcached]: https://www.php.net/manual/en/class.memcached
[closure-docs]: https://www.php.net/manual/en/functions.anonymous.php
[php-the-right-way]: https://phptherightway.com/pages/Functional-Programming.html
