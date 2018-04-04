import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import { signIn } from './actions/'

/**
 * Component Auth.
 */
class Auth extends Component {

    constructor(props) {
        super (props)
        this.state = {
            form: {
                email: null,
                password: null
            }
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)
    }

    onChange = (event) => {
        let f = this.state.form
        f[event.target.name] = event.target.value
        this.setState({form: f})
    }

    onSubmit = (event) => {
        event.preventDefault()
        this.props.signIn(this.state.form)
    }

    render() {

        return (
            <div className="container">
                <div className="row">

                    <div className="col-md-4"></div>

                    <div className="col-md-4 text-center">

                        <img className="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="" />

                        <h1 className="text-center login-title">
                            Sign in to continue to <strong>Madeira Madeira</strong>
                        </h1>

                        <form className="form-signin" onSubmit={this.onSubmit}>
                            <input onChange={this.onChange} type="email" name="email" className="form-control" placeholder="E-mail" required />
                            <input onChange={this.onChange} type="password" name="password" className="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required />
                            <button className="btn btn-lg btn-primary btn-block" type="submit">
                                Sign in
                            </button>
                        </form>

                        <a href="#register" className="text-center new-account">Create an account</a>

                    </div>

                    <div className="col-md-4"></div>

                </div>
            </div>
        )
    }
}

const mapStateToProps = state => ({ })
const mapDispatchToProps = dispatch => bindActionCreators({ signIn }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Auth)
