<?php

namespace MadeiraMadeira\Application\Exceptions;
use MadeiraMadeira\Application\Exceptions\CustomExceptionInterface;
use MadeiraMadeira\Application\Http\Response;

/**
 * Custom Exception Abstract Class.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
abstract class CustomException extends \Exception implements CustomExceptionInterface
{
    /**
     * @var string
     */
    protected $message = 'Unknown exception';
    /**
     * @var string
     */
    private $string;
    /**
     * @var int
     */
    protected $code = 0;
    /**
     * @var string
     */
    protected $file;
    /**
     * @var int
     */
    protected $line;
    /**
     * @var bool
     */
    private $trace;

    /**
     * CustomException constructor.
     */
    public function __construct($message = null, $code = 0)
    {
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        $this->message = $message;
        $this->code = $code;
        $this->render();
    }

    /**
     * Magic method.
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
                                . "{$this->getTraceAsString()}";
    }

    /**
     * Render exception.
     * @return string
     */
    public function render()
    {
        // TODO in production mode, response is in json format.
        // if ( env('APP_ENV', 'local') === 'production' ) {
            return Response::json(
                [
                    'message' => $this->message,
                    'status' => $this->code
                ], $this->code
            );
        // }
    }
}
