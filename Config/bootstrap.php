<?php

/**
 * Please copy the config below and place it on your /app/Config/bootstrap.php
 * Remember to fill in the fields!
 */
    
Configure::write('Amazon.key', '');
Configure::write('Amazon.secret', '');
Configure::write('Amazon.bucket', '');
Configure::write('Amazon.region', 'us-east-1');

require APP . 'Plugin' . DS . 'AmazonManager' . DS . 'Lib' . DS . 'AmazonUtility.php';