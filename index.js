import React, { Component } from 'react'
import ReactDOM from 'react-dom';
import RootComponent from './RootComponent';
import ProductListComponent from './components/Product/ProductListComponent';


// List of product Component
ReactDOM.render(
    <RootComponent>
        <ProductListComponent/>
    </RootComponent>
, document.getElementById('productListFragment'));




