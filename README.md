# Yesbee Connector

```javascript
this.from('yesbee://0.0.0.0:10000/sendEmail') // use http://
.to('smpt://localhost');
```

```php
$yesbeeConnector = Yesbee::factory('192.168.1.10', '10000');
$yesbeeConnector->post('/sendEmail', array(
'anu'
));

$exchange = $yesbeeConnector
->exchange(array(
// body
))
->header('da', 'da')
->send('/sendEmail');
```

```php

$yesbee = Yesbee::factory('192.168.1.10', '10000');
$yesbee->post('sendEmail', array(
    'anu'
));

$yesbee->sendEmail(array(
    'anu'
), $headers);

$exchange = $yesbee
    ->exchange(array(
        // body
    ))
    ->header('da', 'da')
    ->send('/sendEmail');

class Connector {
    public function __call($method, $args)
    {
        return call_user_func_array(array($this, 'post'), array('/'.$method) + $args);
    }
}
```

```php
$client = Yesbee::facetory('http://localhost', 4000);

$client
->post('/checkout', array(
    'key' => 'value'
))
->header('key', 'value')
->header(array())
->send();

$client
->exchange(array())
->header('key', 'value')
->header(array())
->send('/checkout');

```

## Yesbee\Connector

### send(/* string */ $uri)

## Yesbee\Exchange

### header(/* string */ $key, /* mixed */ $value)
### header(/* array */ $headers)

### body(/* mixed */ $body)
### send(/* string */ $uri)

use Guzzle `Norm use this library`

-------------------------------------------------------------------------------

# TODO

- component mongo: (optional)
- access config from context

```javascript
this.context.config('anu.gemes');
```

from manifest.json
```json
{
    "config": {
        "anu": {
            "gemes": "xxx"
        }
    }
}
```

## Store -> Checkout Engine (REDIRECT)

open /initiate?store_id=xyz&api_token=asd420fE&amount=123456

## Checkout Engine -> (yesbee) Core Acq

REQ:
```
GET /checkout.json?store_id=xyz&api_token=asd420fE&amount=123456
Content-Type: application/json
```

RESP:
```

Body:
{
    "refnum": "xyz:asd420fE"
    "store_id": "xyz",
    "amount": 123456,
    "fee": 12345,
    "total": 123456 + 12345
}
```

## Checkout Engine display checkout page

- Generate QRCode based on data
- Build socketio connection to yesbee

xxx
xxx
xxx

## Store -> yesbee (socketio)

```
socketio::emit('wait-for-payment', {
    "refnum": "xxx"
})
```

yesbee akan simpan

## QRCode -> scan mobile app (out of scope)
...
...

## Issuer -> (yesbee) Core Acq

REQ:
```
POST /checkout/:refnum.json

{
    "refnum": "xxx"
    "store_id": "xxx",
    "amount": 123456,
    "fee": 12345,
    "total": 123456 + 12345,
    "issuer_data": "xxx"
}
```

RESP:
```
Status Code:
200 OK
```

## Core Acq -> yesbee:/checkout/:refnum/paid
## Core Acq -> yesbee:/email

## socketio-emit:

```
emit('paid', {})
```

------------------------------------------------

## Not used
REQ:
```
GET /initiate 
# Content-Type: application/json

Body:
{
    "store_id": "xxx",
    "api_token": "xxx",
    "amount": 123456
}
```

RESP:
```

Body:

```
