import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'
import { getUserContacts } from './actions/'

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
                                <a class="navbar-brand">Olá, {user.first_name}</a>
                            </nav>

                        </div>
                    </div>

                    <br />

                    <div className="row">
                        <div className="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Your booklist</h5>

                                        <div class="card">
                                            <div class="card-body">
                                                teste
                                            </div>
                                        </div>

                                </div>
                            </div>

                        </div>
                    </div>
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
    auth: state.auth
})
const mapDispatchToProps = dispatch => bindActionCreators({
    getUserContacts
}, dispatch)
export default connect(mapStateToProps, mapDispatchToProps)(Index)
