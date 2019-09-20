import React, { Component } from 'react'
import ProductComponent from './ProductComponent';
class ProductListComponent extends Component {
    
    render() {
        return (
            <React.Fragment>
                <ProductComponent></ProductComponent>
                 <ProductComponent></ProductComponent>
            </React.Fragment>
          
        )
    }
}
export default ProductListComponent;