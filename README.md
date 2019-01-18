[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/porcelanosa/memed/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/porcelanosa/memed/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/porcelanosa/memed/badges/build.png?b=master)](https://scrutinizer-ci.com/g/porcelanosa/memed/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/porcelanosa/memed/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
# PHP implementation of Memcached protocol
[memcached](http://www.memcached.org/) is a high-performance, distributed memory object caching system, generic in nature, but intended for use in speeding up dynamic web applications by alleviating database load.

[Memcached protocol](https://github.com/memcached/memcached/blob/master/doc/protocol.txt)

This implementation does not need [PHP memcached extension](http://php.net/manual/en/book.memcached.php) or any other

## Usage
Сreate class instance
```php 
$mem = new Memed\Memed($server, $port);
```
**$server** - address of server, where _memcached_ runs (default **_127.0.0.1_**)

**$port** - port that listens to _memcached_ (default **_11211_**)
## Methods

### get($key)
Returns value by key
```php
$mem->get('mykey')
```

### set($key, $value, $flag, $exptime )
Returns value by key
```php
$mem->set('mykey', 'myluxuryvalue')
```
**$flags** - 32-bit unsigned integer that the server store with the data (provided by the user), and return along the data when the item is retrieved (default **_0_**)

**$exptime** -  expiration time in seconds, 0 mean no delay, if exptime is superior to 30 day, Memcached will use it as a UNIX timestamps for expiration (default **_0_**)

### delete($key)
Removes value by key
```php
$mem->delete('mykey')
```
Returns _**true**_ on success or _**false**_ otherwise
### getStats()
Basic stats
Return general-purpose statistics like uptime, version, memory occupation, …
```php
$mem->getStats()
```
### getItemsStats()
Return items statistics, will display items statistics (count, age, eviction, …) organized by slabs ID
```php
$mem->getItemsStats()
```
### getSlabsStats()
Return slabs statistics, will display slabs statistics (size, memory usage, commands count, …) organized by slabs ID
```php
$mem->getSlabsStats()
```
## Demo
[Demo site](https://mem.sa6.ru/)