import '../common/templates/dependecies'

import React, { Component } from 'react'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import App from './app'

class Application extends Component {

    constructor(props){
        super(props)
    }

    render() {
        return <App />
    }

}

const mapStateToProps = state => ({})
const mapDispatchToProps = dispatch => bindActionCreators({  }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Application)
