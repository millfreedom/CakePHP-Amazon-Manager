# CakePHP Amazon Manager

An Amazon AWS manager for CakePHP

## Background

A simple manager with plugins for S3

## Requirements

* PHP >= 5.3
* CakePHP 2.x
* Basic knowledge of Amazon AWS API

## Installation

_[Manual]_

* Download this: http://github.com/asugai/CakePHP-Amazon-Manager/zipball/master
* Unzip that download.
* Copy the resulting folder to app/Plugin
* Rename the folder you just copied to AmazonManager

_[GIT Submodule]_

In your app directory type:

	git submodule add git://github.com/asugai/CakePHP-Amazon-Manager.git Plugin/AmazonManager
	git submodule update --init

_[GIT Clone]_

In your app directory type

	git clone git://github.com/asugai/CakePHP-Amazon-Manager.git Plugin/AmazonManager

### Enable plugin

Enable the plugin your `app/Config/bootstrap.php` file:

	CakePlugin::load('AmazonManager');

If you are already using `CakePlugin::loadAll();`, then this is not necessary.

## Usage

### Setup AmazonManager

Setup the `autoloader` if you are using composer in `/app/Config/bootstrap.php`:

    // Load composer autoload.
    require APP . '/Vendor/autoload.php';

    // Remove and re-prepend CakePHP's autoloader as composer thinks it is the most important.
    // See https://github.com/composer/composer/commit/c80cb76b9b5082ecc3e5b53b1050f76bb27b127b
    spl_autoload_unregister(array('App', 'load'));
    spl_autoload_register(array('App', 'load'), true, true);
    
    // Load the bootstrap file to load Amazon Model
    CakePlugin::loadAll([
        'AmazonManager' => [
            'bootstrap' => true
        ]
    ]);

Edit `/app/Config/bootstrap.php` file and add `Stripe.test` and `Stripe.live` keys:

    Configure::write('Amazon.key', '');
    Configure::write('Amazon.secret', '');
    Configure::write('Amazon.bucket', '');
    Configure::write('Amazon.region', 'us-east-1');

## Todo

* Add namespaces
* Comments!
* Set up more error checking
* Add Unit tests!

## Aknowledgements

The basic layout of this of this README was taken from https://github.com/dkullmann/CakePHP-Elastic-Search-DataSource

## License

Copyright (c) 2013 Andre Sugai

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.