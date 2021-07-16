<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class ApiResponseCollection.
 *
 * @package App\Http\Resources
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
class ApiResponseCollection extends ResourceCollection implements ResponseInterface
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @var int|string
     */
    private string $statusCode;

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
     * @param int|string $statusCode
     * @param array $headers
     * @param int $encodingOptions
     */
    public function __construct(
        $resource,
        string $message,
        string $statusCode = JsonResponse::HTTP_OK,
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
        $this->additional(['message' => $this->message]);

        return parent::toArray($request);
    }

    /**
     * @inheritDoc
     */
    public function withResponse($request, $response)
    {
        $response
            ->setStatusCode($this->statusCode)
            ->withHeaders($this->headers)
            ->setEncodingOptions($this->encodingOptions);
    }
}
