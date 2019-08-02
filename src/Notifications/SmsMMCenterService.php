<?php


namespace Avlima\SmsMMCenter\Notifications;


use GuzzleHttp\{Client, Psr7\Request as GuzzleRequest};
use Illuminate\Support\Arr;
use Illuminate\Http\Response;

class SmsMMCenterService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $params;

    /**
     * @var GuzzleRequest
     */
    private $request;

    /**
     * @var array
     */
    private const SUCCESS_STATUS
        = [
            0,
            010,
            012,
            014,
        ];

    /**
     * SmsMMCenter constructor.
     *
     * @param Client        $client
     * @param GuzzleRequest $request
     * @param array         $params
     */
    public function __construct(Client $client, GuzzleRequest $request, array $params)
    {
        $this->client  = $client;
        $this->request = $request;
        $this->params  = $params;
    }

    /**
     * @param string $to
     * @param string $message
     *
     * @return array
     */
    public function sendMessage(string $to, string $message): array
    {
        $promise = $this->client->sendAsync($this->request, [
            'query' => array_merge($this->params, ['destino' => $to, 'mensagem' => $message]),
        ]);

        $response = $promise->wait();
        $content  = strtok($response->getBody()->getContents(), "\r\n");
        $contents = explode('-', $content);

        if (count($contents) && in_array($content[0], self::SUCCESS_STATUS)) {
            return [
                'id'      => preg_replace(
                    '/[^0-9]/',
                    '',
                    trim(Arr::get($contents, 2, null))
                ),
                'message' => trim(Arr::get($contents, 1, Response::HTTP_OK)),
                'status'  => trim(Arr::get($contents, 0, Response::$statusTexts[Response::HTTP_OK])),
            ];
        }

        return [
            'message' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'status'  => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
        ];
    }
}
