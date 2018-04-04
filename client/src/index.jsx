import React from 'react'
import ReactDOM from 'react-dom'
import { applyMiddleware, createStore } from 'redux'
import { Provider } from 'react-redux'

import promise from 'redux-promise'
import multi from 'redux-multi'
import thunk from 'redux-thunk'

import Application from './main/authOrApp'
import reducers from './main/reducers'

import { setUser } from './components/auth/actions/'
import { header } from './common/axiosMiddleware/'
import consts from './config/consts'

import { loadingBarMiddleware } from 'react-redux-loading-bar'

const devTools = window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
const store = applyMiddleware(multi, thunk, promise, loadingBarMiddleware())(createStore)(reducers, devTools)

/**
 * Convert sessionStorage data to Redux storage.
 */
if (window.sessionStorage.getItem(consts.USER)) {
    store.dispatch(header(JSON.parse(window.sessionStorage.getItem(consts.USER))))
    store.dispatch(setUser(JSON.parse(window.sessionStorage.getItem(consts.USER))))
}

/**
 * Render.
 */
ReactDOM.render(
    <Provider store={store}>
        <Application />
    </Provider>,
    document.getElementById('app')
)
