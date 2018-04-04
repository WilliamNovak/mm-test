import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import Helmet from 'react-helmet'

/**
 * Component Header.
 */
class Header extends Component {

    constructor(props) {
        super (props)
    }

    render() {

        return (
            <div />
        )
    }
}

const mapStateToProps = state => ({ })
const mapDispatchToProps = dispatch => bindActionCreators({  }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Header)
