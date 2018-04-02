<?php

namespace MadeiraMadeira\Application\Http;

/**
 * Application Controller
 *
 * @author William Novak <williamnvk@gmail.com>
 */
abstract class Controller {

    public function __construct()
    {

    }

    /**
     * Magic method to retrive instance of this class.
     *
     * @see http://php.net/manual/en/language.oop5.magic.php#object.invoke
     */
    public function __invoke()
    {
        return;
    }

}
