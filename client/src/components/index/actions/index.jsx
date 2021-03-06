import { toastr } from 'react-redux-toastr'
import axios from 'axios'
import consts from '../../../config/consts'
import { showLoading, hideLoading } from 'react-redux-loading-bar'
import { setAxiosHeader, axiosResponse, header } from '../../../common/axiosMiddleware/'

export const setUserContacts = (contacts = false) => ({type: 'USER_CONTACTS_FETCHED', payload: contacts})
export const setContacts = (contacts = false) => ({type: 'CONTACTS_FETCHED', payload: contacts})

/**
 * Get all contacts by user id.
 * @param int userId
 */
export const getUserContacts = (userId) => {
    return dispatch => {
        dispatch(setAxiosHeader())
        dispatch(showLoading())
        axios({
            url: `${consts.API_URL}/contacts/user/${userId}`,
            method: 'get',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                dispatch([
                    setUserContacts(resp.data.contacts),
                    hideLoading()
                ])
            }
        ).catch(
            err => {
                alert(err.response.data.message)
                dispatch(hideLoading())
            }
        )
    }
}

/**
 * Get all contacts.
 */
export const getContacts = () => {
    return dispatch => {
        dispatch(showLoading())
        axios({
            url: `${consts.API_URL}/contacts`,
            method: 'get',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                dispatch([
                    setContacts(resp.data.contacts),
                    hideLoading()
                ])
            }
        ).catch(
            err => {
                alert(err.response.data.message)
                dispatch(hideLoading())
            }
        )
    }
}


/**
 * Create contact.
 */
export const createContact = (payload = false) => {
    return dispatch => {
        dispatch(showLoading())
        axios({
            url: `${consts.API_URL}/contacts`,
            method: 'post',
            data: {
                contact: payload
            },
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                dispatch([
                    //
                    hideLoading()
                ])
            }
        ).catch(
            err => {
                alert(err.response.data.message)
                dispatch(hideLoading())
            }
        )
    }
}

/**
 * Update contact.
 */
export const updateContact = (contactId = 0, payload = false) => {
    return dispatch => {
        dispatch(showLoading())
        axios({
            url: `${consts.API_URL}/contacts/${contactId}`,
            method: 'put',
            data: {
                contact: payload
            },
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                dispatch([
                    //
                    hideLoading()
                ])
            }
        ).catch(
            err => {
                alert(err.response.data.message)
                dispatch(hideLoading())
            }
        )
    }
}

/**
 * Delete contact.
 */
export const deleteContact = (contactId = 0) => {
    return dispatch => {
        dispatch(showLoading())
        axios({
            url: `${consts.API_URL}/contacts/${contactId}`,
            method: 'delete',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                dispatch([
                    //
                    hideLoading()
                ])
            }
        ).catch(
            err => {
                alert(err.response.data.message)
                dispatch(hideLoading())
            }
        )
    }
}
