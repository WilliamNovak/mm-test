import consts from '../../../config/consts'

const INITIAL_STATE = {
    user: false,
    authenticated: false
}

export default (state = INITIAL_STATE, action) => {
    switch (action.type) {

        case 'USER_FETCHED':
            sessionStorage.setItem(consts.USER, JSON.stringify(action.payload))
            return { ...state, user: action.payload, authenticated: true }

        case 'USER_LOGOUT':
            sessionStorage.removeItem(consts.USER)
            return INITIAL_STATE

        default:
            return state
    }
}
