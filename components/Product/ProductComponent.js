import React from 'react'

const ProductComponent = () => {
 
    return (
        <React.Fragment>
            <div class="col-md-4 col-sm-6 text-center mb-5 product_box position-relative">
                <div class="product"><img src="http://localhost/spectogo/assets/images/frame-2.png" class="w-50 w-sm-75 w-lg-100"/>
                    <h6 class="mb-0 text-color-9 pt-2 pb-1 text-uppercase">Brooksfield</h6>
                    <h5 class="mb-0 font-weight-bold pb-1">Unisex Plastic Frame</h5>
                    <h5 class="mb-0 text-primary font-weight-semibold pb-2">£6.00</h5>
                </div>
              <ul class="choose-glass-color">
                  
              </ul>
              <div class="d-flex flex-row justify-content-center position-absolute w-100 top_position">
                <div class="col-lg-6 col-md-6 col-sm-6 pr-md-0 pr-4 text-left">
                  <button type="button" class="text-uppercase btn btn-primary"><i class="fa fa-heart pr-2" aria-hidden="true"></i> wishlist</button>
                </div>
              </div>
            </div>
        </React.Fragment>
    )
}

export default ProductComponent;
