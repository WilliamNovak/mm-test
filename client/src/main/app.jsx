import React from 'react'
import ToastMessage from '../common/templates/toastr-messages/messages'
import Routes from '../routes/routes'
import Header from '../components/common/header'
import Loading from '../components/common/loading'

/**
 * Main component.
 */
export default props => (
    <div>
        <Header />
        <Loading />
        <div>
            <Routes />
        </div>
        <ToastMessage />
    </div>

)
