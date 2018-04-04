import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import LoadingBar from 'react-redux-loading-bar'

/**
 * Component Loading.
 */
class Loading extends Component {

    constructor(props) {
        super (props)
    }

    render() {

        return (
            <LoadingBar
            showFastActions
            progressIncrease={10} />
        )
    }
}

const mapStateToProps = state => ({ })
const mapDispatchToProps = dispatch => bindActionCreators({  }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Loading)
