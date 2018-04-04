import consts from '../../../config/consts'

const INITIAL_STATE = {
    user: false,
    authenticated: false,
    page: 'logIn'
}

export default (state = INITIAL_STATE, action) => {
    switch (action.type) {

        case 'USER_FETCHED':
            sessionStorage.setItem(consts.USER, JSON.stringify(action.payload))
            return { ...state, user: action.payload, authenticated: true }

        case 'CHANGE_VIEW':
            return { ...state, page: action.payload }

        case 'USER_LOGOUT':
            sessionStorage.removeItem(consts.USER)
            return INITIAL_STATE

        default:
            return state
    }
}
