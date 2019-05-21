<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/17/017
 * Time: 15:56
 */

namespace App\Exception\Handler;

use App\Exception\DevException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;

/**
 * Class DevExceptionHandle
 * @ExceptionHandler(DevException::class)
 * @package App\Exception\Handler
 */
class DevExceptionHandle extends AbstractHttpErrorHandler
{

    /**
     * @param \Throwable $e
     * @param Response $response
     *
     * @return Response
     */
    public function handle(\Throwable $e, Response $response): Response
    {
        // Debug is false
        if (!\APP_DEBUG) {
            return $response->withStatus(500)->withContent(
                \sprintf('#########自定义DevException########### %s At %s line %d', $e->getMessage(), $e->getFile(), $e->getLine())
            );
        }

        $data = [
            'code'  => $e->getCode(),
            'error' => \sprintf('#########自定义DevException###########(%s) %s', \get_class($e), $e->getMessage()),
            'file'  => \sprintf('At %s line %d', $e->getFile(), $e->getLine()),
            'trace' => $e->getTraceAsString(),
        ];

        // Debug is true
        return $response->withData($data);
    }
}