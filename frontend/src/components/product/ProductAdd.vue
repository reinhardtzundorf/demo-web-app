<template>
  <div class="product-add">
    <b-container>
      <b-form class="mt" @submit.prevent="onSubmit">
        
        <!-- RESPONSE -->
        <b-alert class="alert-sm" :variant="responseSuccess ? 'success' : 'danger'" v-if="responseMessage">
          {{ responseMessage }}
        </b-alert>

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
                @change="validateSku"

              ></b-form-input>
              <div class="help-text text-danger" v-if="errors.sku">{{ errors.sku }}</div>
            </b-form-group>
          </div>
        </div>


        <!-- PRODUCT ATTRIBUTES -->
        <div class="form-section">
          <div class="form-row">
            <div class="form-section-title">2. Product Attributes</div>
            <div class="form-section-subtitle">List of attributes which describe the product.</div>
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
                    <tr v-for="index in form.attributes.length" v-bind:key="index">
                        <th colspan="2">{{index+1}}</th>
                        <td colspan="4">{{  }}</td>
                        <td colspan="4">{{ form.attributes[index] }}</td>
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
      <template v-if="isDebugMode">{{ postData }}</template>
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
      responseSuccess: null,
      form: {
        sku: null,
        attributes: []
      },
      postData: {},
      isDebugMode: true,
      disabled: false,
      errors: {}
    };
  },
  props: {
    data: {
        type: Array,
        required: false
    },
    errorResponse: {
      type: String, 
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
     * Validate Sku
     * 
     * This method validates the data received in the form input fields. 
     * The rules are:
     * 
     * - SKU may not be blank
     * - SKU may not exist in the database
     * - attributes may be empty
     * 
     * This method will return an array of errors if the validation failed, or
     * alternatively it just returns true.
     * 
     * @param object formData
     * @return array|true
     */
    validateSku(value) {
      console.log(value)
      this.$http.getByName(value)
                .then(statusCode => {
                  if(statusCode === 204) {
                    alert(statusCode)
                  }
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
        console.log("--------------------------------------------")
        console.log("Adding attribute with key: " + arrayItem.key)
        console.log("Adding attribute with val: " + arrayItem.val)
        console.log("newAttrObject updated value=" + newAttrObject)
        console.log("--------------------------------------------")
        newAttrObject[arrayItem.key] = arrayItem.val
      })

      this.$http.createProduct({sku: this.form.sku, attributes: newAttrObject})
                .then((response) => {
                  if(response.status === 201) {
                    this.$emit('updateUi', {action: 'list', type: 'product'})
                  }
                  this.postData = response
                })
                .catch(error => {
                  console.log(error)
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
      console.log("-------------------------------------")
      console.log("-------------------------------------")
      this.form.attributes.push(e)
    },

  },
  mounted() {

  }
};
</script>

<style lang="css" scoped>

.product-add {
  /*padding: 42px;*/
}

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
