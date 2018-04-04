<?php

namespace Api\Contacts\Services;
use Api\Contacts\Repositories\ContactRepository;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;
/**
 * Contact Service.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class ContactService {

    /**
     * @var ContactRepository
     */
    private $contactRepository;
    /**
     * ContactService constructor.
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Get all contacts.
     *
     * @return array
     */
    public function getAll()
    {
        $contacts = $this->contactRepository->getAll();

        if (empty($contacts)) {
            return Response::json([
                'success' => false,
                'message' => 'no have contacts here.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $contacts;
    }

    /**
     * Get contact by id.
     *
     * @param int $contactId
     * @return array
     */
    public function getById($contactId)
    {
        return $this->getRequestedContact($contactId);
    }

    /**
     * Get contact by user id.
     *
     * @param int $userId
     * @return array
     */
    public function getByUserId($userId)
    {
        $contacts = $this->contactRepository->getByUserId($userId);

        if (empty($contacts)) {
            return Response::json([
                'success' => false,
                'message' => 'no have contacts here.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $contacts;

    }

    /**
     * Get contact by id (only in this class).
     *
     * @param int $contactId
     * @return array
     */
    private function getRequestedContact($contactId)
    {
        $contact = $this->contactRepository->getById($contactId);

        if (empty($contact)) {
            return Response::json([
                'success' => false,
                'message' => 'contact not found.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $contact;
    }

    /**
     * Get contact by id.
     *
     * @param array $data
     * @return array
     */
    public function create($data = [])
    {
        return $this->contactRepository->create($data);
    }

    /**
     * Update contact by id.
     *
     * @param int $contactId
     * @param array $data
     * @return array
     */
    public function update($contactId, $data = [])
    {
        $this->getRequestedContact($contactId);
        return $this->contactRepository->update($contactId, $data);
    }

    /**
     * Delete contact by id.
     *
     * @param int $contactId
     * @return array
     */
    public function delete($contactId)
    {
        $this->getRequestedContact($contactId);
        return $this->contactRepository->delete($contactId);
    }

}
