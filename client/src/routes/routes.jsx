import React from 'react'
import { Router, Route, Redirect, hashHistory } from 'react-router'

import CONSTS from "../config/consts"

import IndexComponent from '../components/index/'
import RegisterComponent from '../components/register/'

/**
 * Rotas do projeto com redirect de rotas desconhecidas para home
 */
export default props => (

    <Router history={hashHistory}>
        <Route path={CONSTS.ROUTES.INDEX} component={IndexComponent} />
        <Route path={CONSTS.ROUTES.REGISTER} component={RegisterComponent} />
        <Redirect from={CONSTS.ROUTES.NOT_FOUND} to={CONSTS.ROUTES.INDEX} />
    </Router>

)
