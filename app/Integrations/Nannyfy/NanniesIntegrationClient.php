<?php

namespace App\Integrations\Nannyfy;

use App\Http\Requests\NanniesRequest;
use GuzzleHttp\Client;

interface NanniesIntegrationClient
{
    public function __construct(Client $http_client);

    public function getNannies(NanniesRequest $request);
}
