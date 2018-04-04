import React from 'react'

export default props => {
    return (
        <div className="card">
            <div className="card-body">
                <h5 className="card-title">
                    <i className="la la-user"></i>
                    {props.name}
                </h5>
                <p className="card-text">
                    <i className="la la-user"></i> {props.email}
                </p>
                <p className="card-text">
                    <i className="la la-user"></i> {props.mobile}
                </p>
                <p className="card-text">
                    <i className="la la-user"></i> {props.address}
                </p>
            </div>
        </div>
    )
}
