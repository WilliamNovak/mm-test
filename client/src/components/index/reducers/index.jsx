import consts from '../../../config/consts'

const INITIAL_STATE = {
    userContacts: false,
    contacts: false
}

export default (state = INITIAL_STATE, action) => {
    switch (action.type) {

        case 'USER_CONTACTS_FETCHED':
            sessionStorage.setItem(consts.USER_CONTACTS, JSON.stringify(action.payload))
            return { ...state, userContacts: action.payload }

        case 'CONTACTS_FETCHED':
            sessionStorage.setItem(consts.CONTACTS, JSON.stringify(action.payload))
            return { ...state, contacts: action.payload }

        default:
            return state
    }
}
