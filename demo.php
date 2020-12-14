<?php

require 'vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
// Include the SDK using the Composer autoloader
date_default_timezone_set($_ENV['time_zone']);
$s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region'  => $_ENV['regin'],
        'endpoint' => $_ENV['endpoint'],
        'use_path_style_endpoint' => (bool)$_ENV['use_path_style_endpoint'],
        'credentials' => [
                'key'    => $_ENV['access_key'],
                'secret' => $_ENV['access_secret'],
            ],
]);


// Send a PutObject request and get the result object.
$insert = $s3->putObject([
     'Bucket' => $_ENV['s3_bucket'],
     'Key'    => $_ENV['test_key'],
     'Body'   => 'Hello from MinIO!!'
]);

// Download the contents of the object.
$retrive = $s3->getObject([
     'Bucket' => $_ENV['s3_bucket'],
     'Key'    => $_ENV['test_key'],
     'SaveAs' => 'testkey_local'
]);

// Print the body of the result by indexing into the result object.
echo $retrive['Body'];

?>