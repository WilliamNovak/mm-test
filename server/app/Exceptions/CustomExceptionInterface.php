<?php

namespace MadeiraMadeira\Application\Exceptions;

/**
 * Custom Exception Interface.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
interface CustomExceptionInterface
{
    public function getMessage();
    public function getCode();
    public function getFile();
    public function getLine();
    public function getTrace();
    public function getTraceAsString();
    public function __toString();
    public function __construct($message = null, $code = 0);
    public function render();
}
