<?php

namespace J3dyy\SmsOfficeApi\Client;

class Response
{

    public int $code;

    public bool $success;

    public string $message;

    public ?string $body;

    /**
     * @param bool $success
     * @param string $message
     * @param ?string $body
     * @param int $code
     */
    public function __construct(bool $success, string $message, ?string $body, int $code = 200)
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
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }




    public static function of( \stdClass $stdClass ){
        //todo validate stdclass

        return new Response($stdClass->Success, $stdClass->Message, $stdClass->Output, $stdClass->ErrorCode);
    }

}