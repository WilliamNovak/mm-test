import '../common/templates/dependecies'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import App from './app'
import Auth from '../components/auth/'
import Routes from '../routes/routes'

class AuthOrApp extends Component {

    constructor(props){
        super(props)
    }

    render() {

        const { user } = this.props.auth

        if (!user) {
            return <Auth />
        }

        return <App />

    }

}

const mapStateToProps = state => ({ auth: state.auth })
const mapDispatchToProps = dispatch => bindActionCreators({ }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(AuthOrApp)
