import { toastr } from 'react-redux-toastr'
import axios from 'axios'
import consts from '../../../config/consts'
import { showLoading, hideLoading } from 'react-redux-loading-bar'
import { setAxiosHeader, axiosResponse, header } from '../../../common/axiosMiddleware/'
import { setUser } from '../../auth/actions/'

export const signUp = (payload) => {
    return dispatch => {
        dispatch(showLoading())
        axios({
            url: `${consts.API_URL}/register`,
            method: 'post',
            data: {
                user: payload
            },
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(
            resp => {
                alert('Success, account has created!')
                dispatch([
                    setUser(resp.data.user),
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
