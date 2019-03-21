<?php

namespace TwoDotsTwice\ISchoolApiClient;

use Exception;
use Http\Client\Exception as ClientException;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use function http_build_query;
use function str_replace;
use Symfony\Component\Serializer\Serializer;
use TwoDotsTwice\ISchoolApiClient\Model\Activity;
use TwoDotsTwice\ISchoolApiClient\Http\ErrorResponseException;
use TwoDotsTwice\ISchoolApiClient\Model\Info;
use TwoDotsTwice\ISchoolApiClient\Serializer\SerializerFactory;

class HttplugApiClient implements ApiClient
{
    private const TYPE_ACTIVITIES_JSON = 'ACTIVITIES_JSON';
    private const TYPE_INFO_JSON = 'INFO_JSON';

    private const PARTNER_PLUGIN = 'PLUGIN';

    /**
     * @var string
     */
    private $baseUrl = ApiClient::BASE_URL;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var string
     */
    private $client;

    /**
     * @var CheckSumCalculator
     */
    private $checkSumCalculator;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        CheckSumCalculator $checkSumCalculator,
        string $client
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->client = $client;
        $this->checkSumCalculator = $checkSumCalculator;

        $this->serializer = (new SerializerFactory())->createSerializer();
    }

    private function getQueryData(string $type): array
    {
        $query_data = [
            'ppartnerid' => self::PARTNER_PLUGIN,
            'pclient' => $this->client,
            'ptype' => $type,
            'pchecksum' => $this->checkSumCalculator->checkSum(
                self::PARTNER_PLUGIN,
                $this->client,
                $type
            ),
        ];

        return $query_data;
    }

    private function getInfoQuery(): string
    {
        $query_data = $this->getQueryData(self::TYPE_INFO_JSON);

        return http_build_query($query_data);
    }

    private function getActivitiesQuery(): string
    {
        $query_data = $this->getQueryData(self::TYPE_ACTIVITIES_JSON);

        return http_build_query($query_data);
    }

    /**
     * @return Activity[]
     */
    public function getActivities(): array
    {
        $url =
            $this->baseUrl
            . 'lid/ischool/ischool.plugin?'
            . $this->getActivitiesQuery();

        $request = $this->requestFactory->createRequest('GET', $url);

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientException $e) {

        } catch (Exception $e) {

        }

        if (200 !== $response->getStatusCode()) {
            throw new ErrorResponseException(
                'Received a response from i-School, indicating an error',
                $response->getStatusCode()
            );
        }

        $body = (string)$response->getBody();

        $body = $this->fixInconsistencies($body);

        $activities = $this->serializer->deserialize(
            $body,
            Activity::class . '[]',
            'json'
        );

        return $activities;
    }

    public function getInfo(): Info
    {
        $url =
            $this->baseUrl
            . 'lid/ischool/ischool.plugin?'
            . $this->getInfoQuery();

        $request = $this->requestFactory->createRequest('GET', $url);

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientException $e) {

        } catch (Exception $e) {

        }

        if (200 !== $response->getStatusCode()) {
            throw new ErrorResponseException(
                'Received a response from i-School, indicating an error',
                $response->getStatusCode()
            );
        }

        $body = (string)$response->getBody();

        $info = $this->serializer->deserialize(
            $body,
            Info::class,
            'json'
        );

        return $info;
    }


    private function fixInconsistencies($body)
    {
        $replacements = [
            '"item_current_reservations":"0"' => '"item_current_reservations":0',
            '"item_current_reservations":null' => '"item_current_reservations":0',
            '"item_max_reservations":null' => '"item_max_reservations":0',
            '"item_price":null' => '"item_price":0',
            '"item_price":"0.00"' => '"item_price":0',
        ];

        $body = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $body
        );

        return $body;
    }
}
