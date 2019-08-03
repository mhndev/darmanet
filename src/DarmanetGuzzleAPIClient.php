<?php
namespace mhndev\darmanet;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use mhndev\darmanet\Exception\InvalidFunctionException;
use JsonException;
use mhndev\darmanet\Exception\InvalidIPException;
use mhndev\darmanet\Exception\UnknownException;
use Exception;

/**
 * Class DarmanetAPIClient
 * @package mhndev\darmanet
 */
class DarmanetGuzzleAPIClient implements iDarmanetAPIClient
{


    /**
     * @var array
     */
    protected $default_config = [
           'base_uri'                    => 'http://185.208.175.77/Babimam_Test/api/v1',
           'current_issuance_uri'        => '/currentInsurance',
           'disease_list_uri'            => '/disease',
           'plan_list_uri'               => '/plan',
           'plan_covers_uri'             => '/planCovers‬',
           'body_part_list_uri'          => '/bodyPart',
           'province_list_uri'           => '/Province',
           'city_list_uri'               => '/Cities',
           'enquiry_for_single_plan_uri' => '/inquery‬‬',
           'enquiry_for_all_plans_uri'   => '/Inquery‬‬/plans',
           'issue_uri'                   => '/',
    ];

    /**
     * @var Client
     */
    private $http_client;

    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var UrlGenerator
     */
    private $url_generator;

    /**
     * DarmanetAPIClient constructor.
     *
     * This class has defaults for every single config
     * but if any value is passed to this class a config then these values should be override
     *
     * @param string $username
     * @param string $password
     * @param array $config
     *
     *
     * sample config array :
     * [
     *      'base_uri' => '',
     *      'current_issuance_uri'        => '',
     *      'disease_list_uri'            => '',
     *      'plan_list_uri'               => '',
     *      'body_part_list_uri'          => '',
     *      'province_list_uri'           => '',
     *      'city_list_uri'               => '',
     *      'enquiry_for_single_plan_uri' => '',
     *      'enquiry_for_all_plans_uri'   => '',
     *      'issue_uri'                   => '',
     * ]
     */
    function __construct(string $username, string $password, array $config = [])
    {
        $base_uri = $this->config['base_uri'] ?? $this->default_config['base_uri'];
        $this->validator = new Validator();
        $this->url_generator = new UrlGenerator($this->default_config, $config);
        $this->http_client = new Client(['base_uri' => $base_uri]);
        $this->config = $config;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     * @example return data
     *
     * [
     *       {
     *           "id": "91d9773e-98df-4657-8b49-8e622551d75b",
     *           "title": "بدون بیمه پایه"
     *       },
     *       {
     *           "id": "14844931-05d1-44bf-ac7a-fe6f7a30ec59",
     *           "title": "بیمه تامین اجتماعی"
     *       }
     * ]
     */
    function currentIssuance()
    {
        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            ['auth' => [$this->username, $this->password], 'http_errors' => false ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }


    /**
     * [
     *       {
     *           "id": "d67bf765-8f3f-4bef-8c09-6ab9635cdefb",
     *           "text": "آب سیاه، Glaucoma"
     *       },
     *       {
     *           "id": "82be6c09-2b77-4bc2-b5cc-6b2ee5cfc952",
     *           "text": "آب مروارید، Cataract"
     *       },
     *       {
     *           "id": "14b75b1f-95f1-4131-b35d-5d63dc49fc8f",
     *           "text": "آبسه"
     *       }
     * ]
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     */
    function diseaseList()
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }


    /**
     *
     * [
     *       {
     *           "id": "4634b989-25a9-4e78-934b-b7ceaa6763dc",
     *           "title": "مهر سامان"
     *       },
     *       {
     *           "id": "12324ba6-f010-4e56-bfaf-ae38780f3ce9",
     *           "title": "سروش سامان"
     *       },
     *       {
     *           "id": "f5883667-e5ec-40e0-9d3b-e3f2d4a9eec5",
     *           "title": "شمیم سامان"
     *       },
     *       {
     *           "id": "a13b43ce-f660-4778-83f8-7ddc15074268",
     *           "title": "وصال سامان"
     *       },
     *       {
     *           "id": "67462a94-56bf-46e6-8ce2-9a849d9c0faa",
     *           "title": "عقیق سامان"
     *       }
     *  ]
     *
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     */
    function planList()
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }


    /**
     * @inheritDoc
     *
     * @param array $plan_ids
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     */
    public function getPlanCovers(array $plan_ids)
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'POST',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false,
                'json' => ['planExIds' => $plan_ids ]
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }



    /**
     * [
     *       {
     *           "id": "2a295df3-3cd8-41d0-a9d8-df806400d537",
     *           "text": "دهان"
     *       },
     *       {
     *           "id": "f250060b-2b5d-4774-821c-59a3ca0f2998",
     *           "text": "دندان"
     *       },
     *       {
     *           "id": "616f429d-9318-4c55-8fc3-1105eae5c793",
     *           "text": "زبان"
     *       }
     * ]
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     */
    function bodyPartList()
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }
            
            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }


    /**
     *
     *   curl -X GET \
     *       'http://185.208.175.77/Babimam_Test/api/v1/Province?=' \
     *       -H 'Accept-Encoding: gzip, deflate' \
     *       -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *       -H 'Connection: keep-alive' \
     *       -H 'Host: 185.208.175.77' \
     *       -H 'cache-control: no-cache'
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     */
    function provinceList()
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }


    /**
     *   curl -X GET \
     *       'http://185.208.175.77/Babimam_Test/api/v1/Cities?=' \
     *       -H 'Accept-Encoding: gzip, deflate' \
     *       -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *       -H 'Cache-Control: no-cache' \
     *       -H 'Connection: keep-alive' \
     *       -H 'Host: 185.208.175.77'
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     */
    function cityList()
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }


    /**
     *
     * @param array $parameters
     * @return void
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     * @example :
     * post request sample curl :
     *
     * curl -X POST \
     *       'http://{{base_url}}/inquery%E2%80%AC%E2%80%AC' \
     *       -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *       -H 'Content-Type: application/json' \
     *       -H 'cache-control: no-cache' \
     *       -d '{
     *               "BirthDate": "1370-11-12",
     *               "Sex": 0,
     *               "CurrentInsuranceId": "91d9773e-98df-4657-8b49-8e622551d75b",
     *               "Height": 187,
     *               "Weight": 88,
     *               "SmokesCigar": true,
     *               "SmokesPerDay": 3,
     *               "SmokesYears": 18,
     *               "DiseaseIds": [],
     *               "HasSurgery": true,
     *               "SurgeyBodyPartIds": [],
     *               "RelativeDisease": true,
     *               "RelativeDiseaseFather": false,
     *               "RelativeDiseaseMother": true,
     *               "PlanId": "4634b989-25a9-4e78-934b-b7ceaa6763dc"
     *           }'
     *
     *
     * @example
     *
     * return data example :
     *
     * {
     *     "price": "7,877,523",
     *     "status": 0,
     *     "message": null
     * }
     */
    function doEnquiryForSinglePlan(array $parameters)
    {
        $this->validator->validateDoEnquiryParameters($parameters);

        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $response = $this->http_client->request(
            'GET',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }    }


    /**
     *
     * curl -X POST \
     *   'http://{{base_url}}/Inquery/plans' \
     *   -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *   -H 'Content-Type: application/json' \
     *   -H 'cache-control: no-cache' \
     *   -d '{
     *           "BirthDate" : "1368-11-08",
     *           "CurrentInsuranceid": "91d9773e-98df-4657-8b49-8e622551d75b",
     *           "Diseaseids":[],
     *           "HasSurgery" :true,
     *           "Height" :"185",
     *           "RelativeDisease" : true,
     *           "RelativeDiseaseFather" :false,
     *           "RelativeDiseaseMother" : true,
     *           "Sex" : 0,
     *           "SmokesCigar" : true,
     *           "SmokesPerDay" : 3,
     *           "SmokesYears" :18,
     *           "SurgeryBodyPartids" : ["f250060b-2b5d-4774-821c-59a3ca0f2998"],
     *           "Weight" : "85"
     *       }'
     *
     *
     * @param array $parameters
     * @return void
     * @throws GuzzleException
     * @throws InvalidFunctionException
     * @throws InvalidIPException
     * @throws UnknownException
     * @example return data 404- Bad request :
     *
     * {
     *     "priceList": null,
     *     "status": -1,
     *     "message": "BMI '30/4779662232421' برای سن '27' سال قابل قبول نیست."
     * }
     */
    function doEnquiryForAllPlans(array $parameters)
    {
        $headers = ['Authorization' => $this->getAuthorizationHeader() ];

        $this->validator->validateDoEnquiryParameters($parameters);

        $response = $this->http_client->request(
            'POST',
            $this->getConfig('base_uri').$this->url_generator->getUrl(__FUNCTION__),
            [
                'headers' => $headers,
                'http_errors' => false,
                'json' => $parameters
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $e) {

            if((string) $response->getBody() == "error, Invalid IP.") {
                throw new InvalidIPException;
            }

            else throw new UnknownException((string) $response->getBody());
        }
        catch (Exception $e) {
            throw new UnknownException((string) $response->getBody());
        }

    }

    /**
     * @param string $key
     * @return string
     */
    private function getConfig(string $key)
    {
        return $this->config[$key] ?? $this->default_config[$key];
    }


    /**
     * @return string
     */
    private function getAuthorizationHeader()
    {
        $username = $this->username;
        $password = $this->password;

        return "Basic ".base64_encode($username.":".$password);
    }

}
