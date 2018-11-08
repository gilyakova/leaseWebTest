
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import App from './App.vue'
Vue.config.productionTip = false

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('TokenForm', require('./components/TokenForm'));

axios.interceptors.request.use(
  (config) => {
    //let tokenOauth = localStorage.getItem('authtoken');
	let tokenOauth = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJjNjFkNjVmZjA4NzE1Y2Q4ODEyYzYwMDRkNzUxNjM5OTI3YzIxZTBlNmQ1ZDAwZWQyM2I3OThjNjg3YzQxYTlmYTZmM2E5YjhlN2JkOWI5In0.eyJhdWQiOiIxIiwianRpIjoiMmM2MWQ2NWZmMDg3MTVjZDg4MTJjNjAwNGQ3NTE2Mzk5MjdjMjFlMGU2ZDVkMDBlZDIzYjc5OGM2ODdjNDFhOWZhNmYzYTliOGU3YmQ5YjkiLCJpYXQiOjE1NDE1OTkyNzQsIm5iZiI6MTU0MTU5OTI3NCwiZXhwIjoxNTczMTM1Mjc0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.DiwdI4tLFC8ghEz1P4wC-tjJVQRGf6qRjlTc0SQquC_dFI4rjbnecwjQzhejplT22Fnv8Mvay0ZpoTyhmnbPyjqrO12aTQaed0hiQI5q4P4W86uL03vzb9gQMJWx7yii2Id9mqWJgZzI_y1HhfV9-0r_caDhpxrSPbinLxr7Uy0j0DyKnfDuWHFABXeWfpgZ1EOvcUG80VZHKe3To4O6z8TE8X23rUml26PY9hI59GT3ZpaPvDUtE0d0VjfmivTBUvpNWHD4pYrI46sPUgirVD9srw2vk1uXse_Vbg-3SDXxUm-heQVcTNdzDf62Qro2jMsljJYgr_gAf8V9MUd6XaI1C10m_ON_2R2gvfVjjCH-FBQO8CB94N5bR9mfV21cA91U7Kgz4b2umVD9Kg4aB7UN41LTUG-qJqp8_RuDh20I-5wFtsRIEKdw5TMbG9LlkOLWnVVhrGvcyUm8Vinvc1eNckG2719wPlLxpy0S-T_N6jPAPDfY5iwZhvTHOqJmPWhaD27JkRnGxRp8i5CwwZQdlusEGeAlH0gAjt3aeu9QwsqU2I8E-rvpFSUOpodYUt6mppliLCyUa2cLXhRCXnbzMtWUCN-gvYxXo5DBcrulQzFk9xmIH4kMYZgglk-3Yi10QfYGIanzv-oE0Oj103phxtBXPwm6b_G0lugIcok';
    if (tokenOauth) {
      config.headers['Authorization'] = `Bearer ${ tokenOauth }`;
    }
    return config;
  }, 
  (error) => {
    return Promise.reject(error);
  }
);

new Vue({
    el: '#app',
  	template: '<App/>',
  	components: { App }
});