import { CombineReducers, combineReducers } from 'redux'
import { reducer as formReducer } from 'redux-form'
import { reducer as toastrReducer } from 'react-redux-toastr'

/**
 * Components reducers
 */
import AuthReducer from '../components/auth/reducers/'

import { loadingBarReducer } from 'react-redux-loading-bar'


/**
 * Combine all reducers
 */
const rootReducer = combineReducers({
    auth: AuthReducer,
    form: formReducer,
    toastr: toastrReducer,
    loadingBar: loadingBarReducer
})

export default rootReducer
