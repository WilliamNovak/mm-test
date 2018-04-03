<?php

namespace Api\Contacts\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\Request;
use MadeiraMadeira\Application\Http\StatusCode;
use Api\Contacts\Services\ContactService;

use MadeiraMadeira\Application\Authentication\Auth;

/**
 * Contact Controller.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class ContactController extends Controller {

    /**
     * @var ContactService
     */
    private $contactService;
    /**
     * @var Auth
     */
    private $auth;
    /**
     * ContactService constructor.
     */
    public function __construct(ContactService $contactService, Auth $auth)
    {
        parent::__construct();
        $this->contactService = $contactService;
        $this->auth = $auth;
    }

    /**
     * Get all contacts.
     *
     * @return Response
     */
    public function getAll()
    {
        $contacts = $this->contactService->getAll();

        return Response::json([
            'success' => true,
            'contacts' => $contacts
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Get one contact by id.
     * @param int $id
     * @return Response
     */
    public function getById($id = 0)
    {
        $contact = $this->contactService->getById($id);

        return Response::json([
            'success' => true,
            'contact' => $contact
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Get one contact by user id.
     * @param int $userId
     * @return Response
     */
    public function getByUserId($userId = 0)
    {
        $contacts = $this->contactService->getByUserId($userId);

        return Response::json([
            'success' => true,
            'contacts' => $contacts
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Create contact.
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $data = $request->get('contact');
        $contact = $this->contactService->create($data);

        return Response::json([
            'success' => true,
            'contact' => $contact
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Update contact by id.
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update($id = 0, Request $request)
    {
        $data = $request->get('contact');
        $contact = $this->contactService->update($id, $data);

        return Response::json([
            'success' => true,
            'contact' => $contact
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Get one contact by id.
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function delete($id = 0)
    {
        $this->contactService->delete($id);
        return Response::json([
            'success' => true
        ], StatusCode::HTTP_SUCCESS);
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
