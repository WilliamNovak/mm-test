import { toastr } from 'react-redux-toastr'
import axios from 'axios'
import consts from '../../config/consts'

import { logout } from '../../components/auth/actions/'

/**
 * Set Axios header
 */
export function setAxiosHeader(logout = false) {

    if (!axios.defaults.headers.common['authorization']) {
        if (window.localStorage.getItem(consts.USER)) {
            let user = JSON.parse(window.localStorage.getItem(consts.USER))
            axios.defaults.headers.common['authorization'] = {
                username: user.email,
                password: user.password
            }
        }
    }

    /**
     * If logout clean axios header
     */
    if (logout) {
        axios.defaults.headers.common['authorization'] = false
    }

    return {
        type: 'TEMP'
    }
}

/**
 * Check token expiration
 */
export function axiosResponse(e) {
    return dispatch => {
        if (e.response.status == 401 || e.response.status == 400){
            toastr.error('Error!', 'Your session has expired.')
            dispatch ([
                logout()
            ])
        }
    }
}

/**
 * Set Axios header
 */
export function header(user = false) {
    if (user) {

        axios.defaults.headers.common['authorization'] = {
            username: user.email,
            password: user.password
        }
        return {
            type: 'AXIOS_HEADER_UPDATED'
        }
    }
}
