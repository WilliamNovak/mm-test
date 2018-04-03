<?php

namespace MadeiraMadeira\Application\Authentication\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\Request;
use MadeiraMadeira\Application\Http\StatusCode;
use MadeiraMadeira\Application\Authentication\Services\EmailService;

/**
 * Email Controller.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @method check(string $email)
 */
class EmailController extends Controller {

    /**
     * @var EmailService
     */
    private $emailService;
    /**
     * AuthController constructor.
     */
    public function __construct(EmailService $emailService)
    {
        parent::__construct();
        $this->emailService = $emailService;
    }

    /**
     * Check e-mail.
     *
     * @param string $email
     * @return Response
     */
    public function check(Request $request)
    {
        $email = $request->get('email');
        $check = $this->emailService->check($email);
        return Response::json([
            'success' => $check
        ], StatusCode::HTTP_SUCCESS);
    }

}
