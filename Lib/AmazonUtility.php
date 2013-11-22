<?php

use Aws\Common\Aws;
use Aws\S3\Exception\S3Exception;

class AmazonUtility
{

    public static function isValidUpload($file)
    {
        if (is_array($file)) {
            if (!empty($file['tmp_name']) && empty($file['error'])) {
                return true;
            }
        }

        return false;
    }

    public static function pushToS3($id, $file, $model)
    {
        $uri = $model->name . '/' . $id;

        $config = [
            'key' => Configure::read('Amazon.key'),
            'secret' => Configure::read('Amazon.secret'),
            'region' => Configure::read('Amazon.region')
        ];

        $s3 = Aws::factory($config)->get('s3');

        // Upload a publicly accessible file. The file size, file type, and MD5 hash are automatically calculated by the SDK
        try {
            $type = explode('/', $file['type']);

            if (!empty($type[1])) {
                $uri = $uri . '.' . $type[1];
            }

            $result = $s3->putObject(array(
                'Bucket' => Configure::read('Amazon.bucket'),
                'Key' => $uri,
                'Body' => fopen($file['tmp_name'], 'r'),
                'ACL' => 'public-read',
                'ContentType' => $file['type']
                    ));
                    
            return $result['ObjectURL'];
        } catch (S3Exception $e) {
            return false;
        }
    }

    public static function delete($name)
    {
        $result = false;
        if ($name) {
            $config = [
                'key' => Configure::read('Amazon.key'),
                'secret' => Configure::read('Amazon.secret'),
                'region' => Configure::read('Amazon.region')
            ];

            $s3 = Aws::factory($config)->get('s3');
            // Upload a publicly accessible file. The file size, file type, and MD5 hash are automatically calculated by the SDK
            try {
                foreach (Configure::read('Amazon.base_urls') as $base_url) {
                    $imageURI = str_replace($base_url . '/', '', $name);
                }

                $result = $s3->deleteObject([
                    'Bucket' => Configure::read('Amazon.bucket'),
                    'Key' => $imageURI,
                    'VersionId' => null
                        ]);
            } catch (S3Exception $e) {
                $result = false;
            }
        }

        return $result;
    }

}

