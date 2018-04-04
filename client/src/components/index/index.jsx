import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import { getUserContacts } from './actions/'

import Contact from './contactComponent'

const section = (props) => (
    <div className="container">
        <div className="row">
            <div className="col-md-8 col-md-offset-2 col-xs-12">
                <p>
                    {props.children}
                </p>
            </div>
        </div>
    </div>
)

/**
 * Component Index.
 */
class Index extends Component {

    constructor(props) {
        super (props)
    }

    render() {

        const { user } = this.props.auth
        const { userContacts } = this.props.contacts

        let tryContacts = true
        if (!userContacts && tryContacts) {
            this.props.getUserContacts(user.id)
            tryContacts = false
        }

        console.log('# auth.user', user)

        if (user) {
            return (
                <div className="container">

                    <br />

                    <div className="row">
                        <div className="col-md-12 col-xd-12 col-lg-12">
                            <nav className="navbar navbar-dark bg-primary navbar-expand-lg">
                                <a className="navbar-brand" href="#">Madeira Madeira</a>
                                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                    <span className="navbar-toggler-icon"></span>
                                </button>
                                <div className="collapse navbar-collapse" id="navbarNavAltMarkup">
                                    <div className="navbar-nav">
                                        <a className="nav-item nav-link active" href="#">Home <span className="sr-only">(current)</span></a>

                                    </div>
                                    <div className="navbar-nav">
                                        <a className="nav-item nav-link" href="#log-out">Logout</a>
                                    </div>
                                </div>
                            </nav>

                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">Hi, {user.first_name}</a>
                            </nav>

                        </div>
                    </div>

                    <br />

                    {userContacts
                        ?
                            (
                                <div className="row">
                                    <div className="col-md-12 col-xs-12">
                                        <div className="card-columns">
                                            {userContacts.map(
                                                contact => <Contact
                                                key={'user-contact-id-' + contact.id}
                                                {...contact} />
                                            )}
                                        </div>
                                    </div>
                                </div>
                            )
                        :
                            (
                                <div className="row">
                                    <div className="col-md-6 col-xs-12">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h1 className="card-title">
                                                    <i className="la la-times-circle-o"></i>
                                                </h1>
                                                <div class="card-title">Your dont have contacts here.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            )
                    }


                </div>
            )
        }

        return (
            <Section>
                Carregando...
            </Section>
        )
    }
}

const mapStateToProps = state => ({
    auth: state.auth,
    contacts: state.contacts
})
const mapDispatchToProps = dispatch => bindActionCreators({
    getUserContacts
}, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Index)
