<?php

namespace Api\Contacts\Repositories;
use Api\Contacts\Models\Contact;

/**
 * Contact Repository.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class ContactRepository {

    /**
     * @var Contact
     */
    private $contact;
    /**
     * ContactRepository constructor.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get all contacts.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->contact->select()->get();
    }

    /**
     * Get one contact by id column.
     * @param int $contactId
     * @return array
     */
    public function getById($contactId = 0)
    {
        return $this->contact->where('id', '=', $contactId)->first();
    }

    /**
     * Get contacts by user id.
     * @param int $userId
     * @return array
     */
    public function getByUserId($userId = 0)
    {
        return $this->contact->where('user_id', '=', $userId)->get();
    }

    /**
     * Get one contact by id column.
     *
     * @return array
     */
    public function create($data = [])
    {
        return $this->contact->create($data);
    }

    /**
     * Get one contact by id column.
     * @param int $contactId
     * @return array
     */
    public function update($contactId, $data = [])
    {
        return $this->contact->update($contactId, $data);
    }

    /**
     * Delete contact by id.
     * @param int $contactId
     * @return array
     */
    public function delete($contactId = 0)
    {
        return $this->contact->delete($contactId);
    }

}
