<?php

namespace App\Integrations\Nannyfy;

use App\Http\Requests\NanniesRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class NannifyClient implements NanniesIntegrationClient
{
    const NANNIES_SEARCH_CORRECTLY = 200;

    /**
     * @var Client
     */
    private $http_client;

    public function __construct(Client $http_client)
    {
        $this->http_client = $http_client;
    }

    public function getNannies(NanniesRequest $request)
    {
        $nannifySearch = new NannifyInputObject($request);
        $url = $this->getUrlForGetNanniesCall();
        $options = $this->getHttpClientOptions($nannifySearch);

        try {
            $response = $this->http_client->request('POST', $url, $options);
            $response_status = $response->getStatusCode();
            $response_body = $response->getBody()->getContents();

            if (self::NANNIES_SEARCH_CORRECTLY === $response_status) {
                return $response_body;
            } else {
                $this->logError('Exception', $options['body'], $response);
                throw new \Exception();
            }
        } catch (GuzzleException $e) {
            $this->logError('Exception', $options['body'], $e->getMessage());
            throw new \Exception();
        }

    }

    private function getUrlForGetNanniesCall()
    {
        return 'https://nannyfy.com/api/search';
    }

    private function getHttpClientOptions(NannifyInputObject $nannifySearch)
    {
        return [
            'headers' => $this->getHttpHeaders(),


            'body'    => json_encode($nannifySearch),
        ];
    }

    private function getHttpHeaders()
    {
        return [
            'Authorization'   => config('integrations.nannify_token'),
            'Content-Type'    => 'text/plain',
        ];
    }


    private function logError($exceptionType, $requestBody, $apiResponse)
    {
        Log::error('Nannify ' . $exceptionType);
        Log::error('Request:');
        Log::error($requestBody);
        Log::error('Response:');
        Log::error($apiResponse);
    }
}
