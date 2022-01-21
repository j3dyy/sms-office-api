<?php

namespace J3dyy\SmsOfficeApi\Client;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use J3dyy\SmsOfficeApi\Config;

class Request
{
    /**
     * @var string
     */
    protected string $params;

    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var string
     */
    protected string $url = '';


    /**
     * @param SmsQueryBuilder $builder
     */
    public function __construct(SmsQueryBuilder $builder){
        $this->params = $builder->query();

        $this->client = new Client();
    }


    public function send(): Response{
        $this->buildUrl('/v2/send');

        return $this->executeRequest();
    }

    /**
     * @return Response
     */
    public function balance(): Response{
        $this->buildUrl('/getBalance');

        return $this->executeRequest();
    }

    /**
     * @param string $endpoint
     */
    public function buildUrl(string $endpoint){
        $this->url = Config::instance()->get('endpoint') . $endpoint . '/?key=' .  Config::instance()->get('apiKey') . $this->params ;
    }


    /**
     * @param string $response
     */
    public function decodeResponse(string|int $response){
        $decoded = json_decode($response);

        $this->response = Response::of($decoded);
    }

    private function executeRequest(){
        try {
            $res = $this->client->get($this->url);
            $this->decodeResponse($res->getBody()->getContents());

            return $this->response;
        }catch (ClientException | ConnectException $e){
            return new Response(false,$e->getMessage(),null,$e->getCode());
        }
    }

}