/**
 * Product Service
 * 
 * This page creates the service layer for interacting with the 
 * /product endpoint of the API.
 */

import client from '../plugins/axios.js'

export default {

    /**
     * Get Product By Name
     * 
     * This will be used to check whether the sku already exists
     * in the product table in the DB. It will may directly to the 
     * /product/name endpoint.
     * 
     * @param string name
     * @return promise
     */
    list(parameters) {
      return client.get('/product', { params: { parameters } })
    },    

    /**
     * Get Product By Name
     * 
     * This will be used to check whether the sku already exists
     * in the product table in the DB. It will may directly to the 
     * /product/name endpoint.
     * 
     * @param string name
     * @return promise
     */
    getByName(name) {
      return client.get(`/product/${name}`)
    },  

    /**
     * Create Product
     * 
     * This will be used to check whether the sku already exists
     * in the product table in the DB. It will may directly to the 
     * /product/name endpoint.
     * 
     * @param object A JSON representation of the record to be inserted
     * @return promise
     */
    createProduct(data) {
      return client.post(`/product/create`, data)
    },

    /**
     * Service
     * 
     * This method returns the API client.
     * 
     * @return axios object
     */   
    service() {
      return client
    }
    
}