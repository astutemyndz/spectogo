import $ from 'jquery';
import qs from 'qs';
import axios from 'axios';

import notify from 'devextreme/ui/notify';

const getBaseURL = () => 'http://localhost/spectogo';

axios.defaults.baseURL = 'http://localhost/spectogo';
//axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

// return promise;
const post = (url, body = null, options = null) => {
  return axios.post(url, body, options);
}
$(function () {
  // Product add to wishlist start of code
  var $wishListButton = $(".wislist");
  $wishListButton.on('click', function() {

    const id_products = $(this).data("id_products");
    const id_users = $(this).data("id_users");

    const data = {id_products: id_products, id_users: id_users};

    const options = {
      method: 'POST',
      headers: { 'content-type': 'application/x-www-form-urlencoded' },
    };

  
    post("/wishlist/add", qs.stringify(data), options).then(response => {
      response = response.data;
      if(response.statusCode === 401) {
        setTimeout(() => {
          location.href = getBaseURL() + '/sign-in';
        }, 300);
      }

      if(response.statusCode === 201) {
        // added to wishlist
        notify(response.message, 'success', 600);
      }

    }).catch(err => console.log(err));
    
    
  })
  // end of code
});

