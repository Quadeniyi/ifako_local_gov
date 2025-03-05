<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['cloudinary'] = [
    'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
    'api_key'    => getenv('CLOUDINARY_API_KEY'),
    'api_secret' => getenv('CLOUDINARY_API_SECRET'),
];
