<?php
define("VERCEL_RUNTIME", true);

// Use older version of OpenSSL
putenv("OPENSSL_CONF=/etc/ssl/");

// Set PHP runtime version
putenv("PHP_VERSION=8.1");

chdir(__DIR__ . "/../../../");
require __DIR__ . "/../../../vendor/autoload.php";