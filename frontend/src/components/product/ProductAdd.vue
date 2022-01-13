<template>
  <div class="product-add">
    <b-container>
      <b-form class="mt" @submit.prevent="onSubmit">

        <!-- PRODUCT INFO -->
        <div class="form-section">
          <div class="form-row">
            <div class="form-section-title">1. Product Information</div>
            <div class="form-section-subtitle">Please complete the following fields:</div>
          </div>
          <div class="form-row">
            <b-form-group
              id="input-group-1"
              label="Product SKU:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="form.sku"
                type="text"
                placeholder=""
                required
              ></b-form-input>
              <div class="help-text text-danger" v-if="errors.sku">{{ errors.sku }}</div>
            </b-form-group>
          </div>
        </div>


        <!-- PRODUCT ATTRIBUTES -->
        <div class="form-section">
          <div class="form-row">
            <div class="form-section-title">2. Product Attributes</div>
            <div class="form-section-subtitle">List of attributes which describe the product. Duplicate attributes with the same key will not be added. You may add as many as you like.</div>
          </div>
          <div class="form-row" v-if="form.attributes.length === 0">
            <p class="text-help">This product does not have any attributes yet.</p>
          </div>
          <div class="form-row" v-else>
            <div class="form-section-attributes">
              <div class="form-group">
                <table class="table table-hover table-borderless w-100">
                  <thead>
                    <tr>
                        <th colspan="2">#</th>
                        <th colspan="4">Name</th>
                        <th colspan="4">Value</th>
                        <th colspan="2" class="col-remove">Remove Attribute</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(attribute, index) in form.attributes" v-bind:key="index">
                        <th colspan="2">{{index + 1}}</th>
                        <td colspan="4">{{ attribute.key }}</td>
                        <td colspan="4">{{ attribute.val }}</td>
                        <td colspan="2" class="col-remove"><a href="#" v-on:click="removeAttribute(index)">remove</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


        <!-- ATTRIBUTE FORM -->
        <div class="form-section">
          <div class="form-row">
            <div class="form-section-title">3. Add Attribute</div>
            <div class="form-section-subtitle">Complete this form to add a new attribute to the product.</div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <ProductAttributeInput :id="(form.attributes.length+1)" @createAttribute="addAttribute"></ProductAttributeInput>
            </div>
          </div>
        </div>


        <!-- SUBMIT -->
        <div class="form-section">
          <div class="form-row">
            <div class="form-section-title">4. Create Product</div>
            <div class="form-section-subtitle">Please check the details you entered and click the button to create the new product.</div>
          </div>
          <div class="row"><b-button type="submit" variant="success" size="medium">Create Product</b-button></div>
        </div>


      </b-form>
    </b-container>
  </div>
</template>

<script>

import ProductAttributeInput from './components/ProductAttributeInput.vue'

export default {

  name: 'ProductAdd',
  components: {
    ProductAttributeInput
  },
  data() {
    return {
      responseMessage: null,
      responseSuccess: false,
      form: {
        sku: null,
        attributes: []
      },
      postData: {},
      errors: {},
      boxTwo: null
    };
  },
  props: {
    data: {
        type: Array,
        required: false
    }
  },
  methods: {

    /**
     * Remove Attribute
     * 
     * Uses lodash's splice() to remove 1 element by the provided index 
     * value.
     * 
     * @param integer index
     */
    removeAttribute(idx) {
      this.form.attributes.splice(idx, 1)
    },

    /**
     * Show Modal Box
     * 
     * This method displays a modal box to the user with the message 
     * from the outcome of the request to create the product.
     * 
     * @param string message
     * @param function callback
     * @return void
     */
     showModalBox(message, redirect) {
        this.boxTwo = ''
        this.$bvModal.msgBoxOk(message, {
          title: (this.responseSuccess ? 'Operation completed.' : 'Operation failed.'),
          size: 'sm',
          buttonSize: 'sm',
          okVariant: (this.responseSuccess ? 'success' : 'danger'),
          headerClass: 'p-2 border-bottom-0',
          footerClass: 'p-2 border-top-0',
          centered: true
        })
        .then(value => {
          this.boxTwo = value

          if(redirect === true) {

            /**
             * Debounce briefly so that the user can read the message.
             */
            setTimeout(() => {
              this.$emit('updateUi', {action: 'list', type: 'product'})
            }, 1650)
          }

        })
        .catch(err => {
          console.log(err)
        })
     },


    /**
     * On Submit
     * 
     * This method handles the submission of the form in this component. 
     * The product.service.js script is used to handle the requests to 
     * the API backend.
     * 
     * @return void
     */
    onSubmit() {

      /**
       * Transform the attributes before sending them.
       */
      let newAttrObject = {}
      this.form.attributes.forEach((arrayItem) => {
        newAttrObject[arrayItem.key] = arrayItem.val
      })

      /**
       * Service class createProduct() method call sends an outbound request
       * to the /product/create endpoint of the API with the JSON object 
       * representing a new product on the system in the body of the request.
       */
      this.$http.createProduct({sku: this.form.sku, attributes: newAttrObject})
                .then((response) => {

                  /**
                   * HANDLE API RESPONSE.
                   */
                  if(response.status === 201) {
                    
                    /**
                     * Set responseSuccess property to true.
                     */
                    this.responseSuccess = true

                    /**
                     * Set responseMessage property to a message.
                     */
                    this.responseMessage = "Successfully created product! Redirecting shortly.."
                    this.showModalBox(this.responseMessage, true)

                  } else {

                    /**
                     * Set response to false and change the responseMessage property 
                     * from null to an empty string. 
                     */
                    this.responseSuccess = false
                    this.responseMessage = ""
                    
                    /**
                     * Transform the response error messages into one string.
                     */
                    Object.entries(response.data).forEach((val) => {

                      /**
                       * Assign each to the responseMessage property.
                       */
                      this.responseMessage += " " + val

                    })
                    
                    this.showModalBox(this.responseMessage, false)

                  }


                })
                .catch(error => {

                  /**
                   * Error handler for back-end exceptions.
                   */
                  this.showModalBox(error)
                  this.responseSuccess = false
                  this.responseMessage = error

                })
    
    },

    /**
     * Add Attribute
     * 
     * This method handles the event bubbled up from the ProductAttributeElement
     * component.
     * 
     * @param object e
     * @return void
     */
    addAttribute(e) {
      this.form.attributes.push(e)
    },

  }
};
</script>

<style lang="css" scoped>

.product-add p {
  text-align: left;
}

.form-section {
  background-color: #fff;
  padding: 24px;
  margin: 8px;
  box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.05);
  font-size: 14px;
}

.form-section-title {
  font-size:  16px;
  font-weight: 700;
}

.form-section-subtitle {
  font-size:  12px;  
  line-height: 2.0;
  border-bottom: 0.5px solid #efefef;
  margin-bottom: 18px;
}

.form-section-attributes table {
  font-size: 12px;
  color: #444;
  border-color: #666;
}

.form-section-attributes table th {
  border-color: #666;
}

.form-section-attributes table .col-remove {
  text-align: right;
}

.form-section-attributes table .col-remove a {
  color: red !important;
}

</style>
