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
const get = (url, params = null, options = null) => {
  return axios.get(url, params, options);
}
$(function () {
  

 
});

