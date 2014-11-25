<?php

/**
 * Yesbee - Enterprise Service Bus
 *
 * MIT LICENSE
 *
 * Copyright (c) 2013 PT Sagara Xinix Solusitama
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author      Ganesha <reekoheek@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/norm
 * @license     https://raw.github.com/xinix-technology/norm/master/LICENSE
 * @package     Yesbee
 *
 */

namespace Yesbee;

use Guzzle\Http\Client;

class Yesbee
{

    protected $options;
    protected $client;
    protected $request;
    protected $response;
    protected $method;
    protected $uri = null;
    protected $body = array();
    protected $header = array();

    public function factory($opt = null, $port = null)
    {
    	$config = array();
    	if((is_string($opt) && $opt !== null) && $port !== null) {
    		$config['base_url'] = $opt.':'.$port;
    	} else if(is_string($opt) && $opt !== null) {
    		$config['base_url'] = $opt;
    	} else if(is_array($opt)) {
    		$config = $opt;
    	} else {
    		throw new \Exception('Yesbee Missing config, check your configuration!');
    	}
    	return new self($config);
    }

    public function __construct(array $options = array())
    {
    	$this->options = $options;
    	$this->client =  new Client();
    	return $this;
    }

    public function option($key = null)
    {
        if (func_num_args() ===  0) {
            return $this->options;
        } elseif (isset($this->options[$key])) {
            return $this->options[$key];
        }
    }

    public function get($uri = '')
    {
    	$this->method = 'GET';
    	$this->uri = $uri;
    	return $this;
    }

    public function post($uri = '')
    {
    	$this->method = 'POST';
    	$this->uri = $uri;
    	return $this;
    }

    // TODO: fungsi ini masih belum bisa running, belum dapat diimplementasikan pada POST sebagai body
    public function exchange($body = array())
    {
    	$this->body = $body;
    	return $this;
    }


    public function header($opt, $value = null)
    {

    	if((is_string($opt) && $opt !== null) && $value !== null) {
    		$this->header[$opt] = $value;
    	} else if(is_array($opt)) {
    		$this->header = array_merge($this->header, $opt);
    	} else {
    		throw new \Exception('Header missing argument.');
    	}

    	return $this;

    }

    public function sendGet($data)
    {

    	$this->uri = $this->options['base_url'] . $this->uri;

    	// TODO: check again to append query string in Guzzle
    	if($data['query']) {
    		$queryString = http_build_query($data['query']);
    		$this->request = $this->client->get($this->uri.'?'.$queryString);
    	} else {
    		$this->request = $this->client->get($this->uri);
    	}

    	// TODO: $data set body to request
    	if($data['headers']) {
    		foreach ($data['headers'] as $key => $value) {
    			$this->request->setHeader($key, $value);
    		}
    	}
    	return $this->client->send($this->request);
    }

    public function sendPost($data)
    {
    	$this->uri = $this->options['base_url'] . $this->uri;
    	$this->request = $this->client->post($this->uri);

    	if($data['body']) {
    		$this->request = $this->client->post($this->uri, array(), $data['body']);
    	} else {
    		$this->request = $this->client->post($this->uri);
    	}

    	if($data['headers']) {
    		foreach ($data['headers'] as $key => $value) {
    			$this->request->setHeader($key, $value);
    		}
    	}
    	return $this->client->send($this->request);
    }

    public function send($uri = null)
    {
    	if(!$this->method) $this->method = 'POST';
    	$this->uri = $uri ?: $this->uri;

    	$options['headers'] = $this->header;
    	if($this->method === 'POST') {
    		$options['body'] = $this->body;
    		return $this->sendPost($options);
    	} else {
    		$options['query'] = $this->body;
    		return $this->sendGet($options);
    	}
    }

}
