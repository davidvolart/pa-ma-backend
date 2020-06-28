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
            'Authorization'   => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYwYmZlYTA5MjJjZTk1YmMwNzAxMzg2OWQ2MjE1YzdjNTNkZGVkYWU2ZGVkOTk3MGU2MjViMDEyYTFmNzNiYTM4NTg4Y2M3NjExOGFjNWQ1In0.eyJhdWQiOiIxMDQxOTkiLCJqdGkiOiJmMGJmZWEwOTIyY2U5NWJjMDcwMTM4NjlkNjIxNWM3YzUzZGRlZGFlNmRlZDk5NzBlNjI1YjAxMmExZjczYmEzODU4OGNjNzYxMThhYzVkNSIsImlhdCI6MTU4ODQxODE5MiwibmJmIjoxNTg4NDE4MTkyLCJleHAiOjE2MTk5NTQxOTIsInN1YiI6IjUzNDY3Iiwic2NvcGVzIjpbIioiXX0.POn7m3XbMkK_0UJZHNdvKU2ATkqL_bEwAXdgCg09vuhUIcVNbq3Su59fSaqZh2GN7M8jH-kF8tz-HzMMND60CVt9Y1kk5Q8ENOZ4g5_-BtJi78PCf8qbSIegWY0ioeN-YPDdRzM4xYgwHlXHHLg1D79JZHxjX2NeuVuBasBrOK8z_FytkRi0tHarO0iNRh7kgFY-9tYLeRuhuKgqRbDmeuR6ZACWr0eXEwb5px9m3UEq1vtSh83PU4EFgUXJh_k6tyoCI2D3gqwUHowsFdM354ZFnkqXTisYanuvnKcPfFMVTpEkOOy2X35XzQC07jc4cIT1C5n5ZHVI377a_jQu5hMBLVvhXheVeZxo_zcBw6uIAJxmQL6Rg5bnI8ByfwaCxPFZYVjXARpszzaFn868lka3VtmloSlHY-uNW0xS-3r8KchTyUmTqXbCGq2F5DuBWPoY1P5PsIIK84RqXxPaRbmPg_zscNqkNk3J1Pv7kzoKKWpHjEMuQM2HohCuf0PcFpMQ8a70hxm4r35Ma9BzSB5e7rah0pzxXKImdaudaenuLTAe95Ez4RXOXJxFdkMeNrWeLug7igpNFmO_Ie1ZkE1ZMDD-yqhaFct13w88D0WjQOO307SZubL9eugr6ZEVzBbMMgjI3TO9A8QIon18r7WBr06DASuoC4ubm827qXk',
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
