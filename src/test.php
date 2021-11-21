<?php
require_once "../vendor/autoload.php";

use Src\Lib\Main\Web\Http;

$response = Http::getResponse();

//$response->redirect('/', 400);
$response->setCode(301)->sendJSONResponse(['message' => 'this message']);