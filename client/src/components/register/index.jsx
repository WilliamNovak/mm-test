import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import { signUp } from './actions/'

/**
 * Component Register.
 */
class Register extends Component {

    constructor(props) {
        super (props)
        this.state = {
            form: {
                first_name: null,
                last_name: null,
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
        this.props.signUp(this.state.form)
    }

    render() {

        return (
            <div className="container">
                <div className="row">

                    <div className="col-md-4"></div>

                    <div className="col-md-4 text-center">

                        <img className="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="" />

                        <h1 className="text-center login-title">
                            Sign up to entry on <strong>Madeira Madeira</strong>
                        </h1>

                        <form className="form-signin" onSubmit={this.onSubmit}>
                            <input onChange={this.onChange} type="text" maxLength="48" name="first_name" className="form-control" placeholder="Your first name" required />
                            <input onChange={this.onChange} type="text" maxLength="48" name="last_name" className="form-control" placeholder="Your last name" required />
                            <input onChange={this.onChange} type="email" maxLength="112" name="email" className="form-control" placeholder="Your e-mail address" required />
                            <input onChange={this.onChange} type="password" maxLength="12" name="password" className="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required />
                            <button className="btn btn-lg btn-primary btn-block" type="submit">
                                Sign up
                            </button>
                        </form>

                        <a href="#" className="text-center new-account">Log in</a>

                    </div>

                    <div className="col-md-4"></div>

                </div>
            </div>
        )
    }
}

Register.contextTypes = {
    router: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    auth: state.auth
})
const mapDispatchToProps = dispatch => bindActionCreators({ signUp }, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Register)
