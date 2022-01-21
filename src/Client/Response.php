<?php

namespace J3dyy\SmsOfficeApi\Client;

use J3dyy\SmsOfficeApi\Client\Model\Balance;
use J3dyy\SmsOfficeApi\Client\Model\ResponseBody;

class Response
{

    private int $code;

    private bool $success;

    private ?string $message;

    private ?ResponseBody $body;

    /**
     * @param bool $success
     * @param ?string $message
     * @param ?ResponseBody $body
     * @param int $code
     */
    public function __construct(bool $success, ?string $message, ?ResponseBody $body, int $code = 200)
    {
        $this->success = $success;
        $this->message = $message;
        $this->body = $body;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return ResponseBody|null
     */
    public function getBody(): ?ResponseBody
    {
        return $this->body;
    }

    /**
     * @param ResponseBody|null $body
     */
    public function setBody(?ResponseBody $body): void
    {
        $this->body = $body;
    }



    public static function of( $data ): Response{
        //todo validate stdclass
       return self::handleByType($data);
    }

    private static function handleByType($data): Response{
        return match (gettype($data)){
            'object'    => self::buildResponse($data->Message, $data->ErrorCode, $data->Output, $data->Success),
            'integer'   => self::buildResponse(body: new Balance($data))
        };
    }

    private static function buildResponse(?string $message = '', int $code = 200, ?ResponseBody $body = null, bool $success = true){
        return new Response($success,$message,$body,$code);
    }

}