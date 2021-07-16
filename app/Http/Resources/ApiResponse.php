<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ApiResponse.
 *
 * @package App\Http\Resources
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class ApiResponse extends JsonResource implements ResponseInterface
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @var array
     */
    private array $headers;

    /**
     * @var int
     */
    private int $encodingOptions;

    /**
     * Resource constructor.
     *
     * @param $resource
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     * @param int $encodingOptions
     */
    public function __construct(
        $resource,
        string $message,
        int $statusCode = JsonResponse::HTTP_OK,
        array $headers = [],
        int $encodingOptions = JSON_UNESCAPED_UNICODE
    ) {
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->encodingOptions = $encodingOptions;

        parent::__construct($resource);
    }

    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * @inheritDoc
     */
    public function withResponse($request, $response)
    {
        $response
            ->setData(['data' => $this->toArray($request), 'message' => $this->message])
            ->setStatusCode($this->statusCode)
            ->withHeaders($this->headers)
            ->setEncodingOptions($this->encodingOptions);
    }
}
