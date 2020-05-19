# Welcome to HBE Micro Log Service php SDK

This SDK provides a wrapper around the HBE Micro Log Service REST API.

For more info on the HBE Micro Log Service REST API, see our [full documentation](http://micro-log.hotellinksolutions.com/api/documentation).

# Simple example to create a single charge


``` php

Config::initialise("sandbox", "username", "password");

$svc = new UserActivity();
$response = $svc->create('userA','hotelB','pageC','test message','2020-06-01')
    ->call();

```
