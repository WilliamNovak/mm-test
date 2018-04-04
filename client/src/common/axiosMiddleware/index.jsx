import { toastr } from 'react-redux-toastr'
import axios from 'axios'
import consts from '../../config/consts'

import { logout } from '../../components/auth/actions/'

/**
 * Set Axios header
 */
export function setAxiosHeader(logout = false) {

    if (window.sessionStorage.getItem(consts.USER)) {
        let user = JSON.parse(window.sessionStorage.getItem(consts.USER))
        if (user) {
            let basic = btoa(user.email + ':' + user.password)
            axios.defaults.headers.common['Authorization'] = `Basic ${basic}`
        }
    }

    /**
     * If logout clean axios header
     */
    if (logout) {
        axios.defaults.headers.common['auth'] = false
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
        let basic = btoa(user.email + ':' + user.password)
        axios.defaults.headers.common['Authorization'] = `Basic ${basic}`
        return {
            type: 'AXIOS_HEADER_UPDATED'
        }
    }
}
