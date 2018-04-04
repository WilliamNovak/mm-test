import { CombineReducers, combineReducers } from 'redux'
import { reducer as formReducer } from 'redux-form'
import { reducer as toastrReducer } from 'react-redux-toastr'

/**
 * Components reducers
 */
import AuthReducer from '../components/auth/reducers/'
import ContactsReducer from '../components/index/reducers/'

import { loadingBarReducer } from 'react-redux-loading-bar'


/**
 * Combine all reducers
 */
const rootReducer = combineReducers({
    toastr: toastrReducer,
    contacts: ContactsReducer,
    auth: AuthReducer,
    form: formReducer,
    loadingBar: loadingBarReducer
})

export default rootReducer
