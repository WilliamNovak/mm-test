import React from 'react'
import ReduxToastr from 'react-redux-toastr'

/**
 * Component toast para alert de messagens
 */
export default props => (
    <ReduxToastr
        timeOut={3000}
        newestOnTop={false}
        preventDuplicates={true}
        position='top-right'
        transitionIn='fadeIn'
        transitionOut='fadeOut'
        progressBar />

)