<?php

return [
    'user'      => env('MMCENTER_USER'),
    'password'  => env('MMCENTER_PASSWORD'),
    'timeout'   => env('MMCENTER_TIMEOUT'),
    'url'       => env('MMCENTER_URL', 'http://www.mmcenter.com.br/mmenvio.aspx'),
    'operation' => env('MMCENTER_OPERATION', 'ENVIO'),
    'route'     => env('MMCENTER_ROUTE'),
];
