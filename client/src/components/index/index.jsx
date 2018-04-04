import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

/**
 * Component Index.
 */
class Index extends Component {

    constructor(props) {
        super (props)
    }

    render() {

        return (
            <h1>Bem Vindo</h1>
        )
    }
}

const mapStateToProps = state => ({ })
const mapDispatchToProps = dispatch => bindActionCreators({  }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Index)
