<?php

use Aws\Common\Aws;
use Aws\S3\Exception\S3Exception;

class S3Storage
{
    public static function isValid($file)
    {
        if (is_array($file)) {
            if (!empty($file['tmp_name']) && empty($file['error'])) {
                return TRUE;
            }
        }
        
        return FALSE;
    }

    public static function storeFile($id, $file, $model)
    {
        return static::pushToS3($file, );
    }
    
    public static function pushToS3($id, $file, $model)
    {
        $uri = $model->name . DS . $id;
        
        $config = [
            'key' => Configure::read('Amazon.key'),
            'secret' => Configure::read('Amazon.secret'),
            'region' => Configure::read('Amazon.region')
        ];
        
        $s3 = Aws::factory($config)->get('s3');
        
        // Upload a publicly accessible file. The file size, file type, and MD5 hash are automatically calculated by the SDK
        try {       
            $type = explode(DS, $file['type']);
            
            if (!empty($type[1])) {
                $uri = $uri . '.' . $type[1];
            }
            
            $s3->putObject(array(
                'Bucket' => Configure::read('Amazon.bucket'),
                'Key'    => $uri,
                'Body'   => fopen($file['tmp_name'], 'r'),
                'ACL'    => 'public-read',
                'ContentType'  => $file['type']
            ));
            
            return 'http://' . Configure::read('Amazon.bucket') . DS . $uri;
            
        } catch (S3Exception $e) {
            return false;
        }
    }
}
