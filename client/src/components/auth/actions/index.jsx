import { toastr } from 'react-redux-toastr'
import axios from 'axios'
import consts from '../../../config/consts'

import { setAxiosHeader, axiosResponse, header } from '../../../common/axiosMiddleware/'

export const logout = () => {
    return dispatch => {
        dispatch([
            setAxiosHeader(true),
            { type: 'USER_LOGOUT', payload: false }
        ])
    }
}

export const setUser = (user = false) => ({type: 'USER_FETCHED', payload: user})

export const signIn = (payload) => {
    return dispatch => {
        axios({
            url: `${consts.API_URL}/auth/authorize`,
            method: 'post',
            data: {
                auth: payload
            },
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                dispatch(setUser(resp.data.user))
            }
        ).catch(
            e => {
                toastr.error('Error!', e.message)
            }
        )
    }
}
