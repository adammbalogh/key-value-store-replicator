# Key Value Replicator Adapter

[![Author](http://img.shields.io/badge/author-@adammbalogh-blue.svg?style=flat)](https://twitter.com/adammbalogh)
[![Build Status](https://img.shields.io/travis/adammbalogh/key-value-store-replicator/master.svg?style=flat)](https://travis-ci.org/adammbalogh/key-value-store-replicator)
[![Coverage Status](https://img.shields.io/coveralls/adammbalogh/key-value-store-replicator.svg?style=flat)](https://coveralls.io/r/adammbalogh/key-value-store-replicator)
[![Quality Score](https://img.shields.io/scrutinizer/g/adammbalogh/key-value-store-replicator.svg?style=flat)](https://scrutinizer-ci.com/g/adammbalogh/key-value-store-replicator)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/adammbalogh/key-value-store-replicator.svg?style=flat)](https://packagist.org/packages/adammbalogh/key-value-store-replicator)
[![Total Downloads](https://img.shields.io/packagist/dt/adammbalogh/key-value-store-replicator.svg?style=flat)](https://packagist.org/packages/adammbalogh/key-value-store-replicator)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/78454e42-c408-4b3d-9f5a-52a5e97cb7f1/small.png)](https://insight.sensiolabs.com/projects/78454e42-c408-4b3d-9f5a-52a5e97cb7f1)

# Description

This library provides a layer to replicate commands on key value stores.

All the read (get, getTtl, has) operations run only on the source adapter, others on both.

Check out the [abstract library](https://github.com/adammbalogh/key-value-store) to see the other adapters and the Api.

# Installation

Install it through composer.

```json
{
    "require": {
        "adammbalogh/key-value-store-replicator": "@stable"
    }
}
```

**tip:** you should browse the [`adammbalogh/key-value-store-replicator`](https://packagist.org/packages/adammbalogh/key-value-store-replicator)
page to choose a stable version to use, avoid the `@stable` meta constraint.

# Usage

```php
<?php
use AdammBalogh\KeyValueStore\KeyValueStore;
use AdammBalogh\KeyValueStore\Adapter\MemcachedAdapter;
use AdammBalogh\KeyValueStore\Adapter\RedisAdapter;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;


$sourceAdapter = new MemcachedAdapter(new Memcached());
$replicaAdapter = new RedisAdapter(new Predis\Client());

$adapter = new ReplicatorAdapter($sourceAdapter, $replicaAdapter);

$kvs = new KeyValueStore($adapter);

$kvs->set('sample_key', 'Sample value');
$kvs->get('sample_key');
$kvs->delete('sample_key');
```

# API

**Please visit the [API](https://github.com/adammbalogh/key-value-store#api) link in the abstract library.**

# Toolset

| Key                 | Value               | Server           |
|------------------   |---------------------|------------------|
| ✔ delete            | ✔ get               | ✔ flush          |
| ✔ expire            | ✔ set               |                  |
| ✔ getTtl            |                     |                  |
| ✔ has               |                     |                  |
| ✔ persist           |                     |                  |

# Support

[![Support with Gittip](http://img.shields.io/gittip/adammbalogh.svg?style=flat)](https://www.gittip.com/adammbalogh/)
