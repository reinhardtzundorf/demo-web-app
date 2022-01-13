/**
 * AXIOS
 * 
 * This file sets up the axios http client with the config 
 * required to connect to the backend API application.
 * Config values come from the .env file which is loaded
 * in all cases when building the app using the CLI tool.
 */

import axios from 'axios'

const client = axios.create({
    baseURL: 'http://localhost:8080/',
    // baseURL: process.env.VUE_APP_BACKEND_URL,
    withCredentials: false,  
    timeout: 0,
    // headers: {
    //     'Accept': 'application/json',
    //     'Content-Type': 'application/json'

    //     *
    //      * If we were using authentication in this app, then 
    //      * the Authorization header could be specified here 
    //      * and the Bearer token embedded in the header.
         
    //      //'Authorization: Bearer: ....'
    // }
});

/**
 * RESPONSE
 * 
 * Configure the way we handle responses.
 */
client.interceptors.response.use(
  function (response) {
    if (response.status === 200) {
        console.log(response)
    }    
    return Promise.resolve(response)
  },
  function (error) {
    const response = error.response
    console.log(error)
    console.log(response)
    // if (response.status >= 500 && response.data !== undefined && response.data.detail !== undefined) {
    //     console.log(error)
    // } else {
    //     alert('500 error');
    // }
    return Promise.reject(error)
  }
);

export default client