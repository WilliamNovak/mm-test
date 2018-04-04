import React from 'react'

export default props => {
    console.log(props)
    return (
        <div className="card">
            <div className="card-body">
                <h5 className="card-title">
                    <i className="la la-user"></i>
                    {props.name.toLowerCase().replace(/\b[a-z]/g, (letter => letter.toUpperCase()))}
                </h5>
                {props.email ?
                    (
                        <p className="card-text">
                            <i className="la la-at"></i> {props.email}
                        </p>
                    )
                    : null
                }
                {props.mobile ?
                    (
                        <p className="card-text">
                            <i className="la la-mobile"></i> {props.mobile}
                        </p>
                    )
                    : null
                }
                {props.address ?
                    (
                        <p className="card-text">
                            <i className="la la-map-marker"></i> {props.address}
                        </p>
                    )
                    : null
                }



                <p class="card-text">
                    <small class="text-muted">{props.updated_at}</small>
                </p>

            </div>
        </div>
    )
}
