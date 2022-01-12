<template>
  <div class="product-add">
    <b-container>
      <b-form class="mt" @submit.prevent="login">
        
        <!-- RESPONSE -->
        <b-alert class="alert-sm" :variant="responseSuccess ? 'success' : 'danger'" v-if="responseMessage">
          {{ responseMessage }}
        </b-alert>

        <!-- PRODUCT INFO -->
        <div class="form-row">
          <div class="form-group">
            <b-row>
              <b-col lg="2">
                <label class="form-label">SKU:</label>
              </b-col>
              <b-col lg="6">
                <input class="form-control no-border" type="text" name="sku" required @change="validateSku(e)"/>
              </b-col>
            </b-row>
          </div>
        </div>

        <!-- PRODUCT ATTRIBUTES -->
        <div class="form-row" v-if="form.attributes.length > 0">
          <div class="form-group" v-for="(value, key, index) in form.attributes" v-bind:key="index">
            <ProductAttributeInput :id="index" :formName="key" :formValue="value"></ProductAttributeInput>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <ProductAttributeInput :id="(form.attributes.length+1)" @createAttribute="addAttribute"></ProductAttributeInput>
          </div>
        </div>

        <!-- SUBMIT -->
        <b-button type="submit">Create Product</b-button>

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
      responseSuccess: null,
      form: {
        sku: null,
        attributes: []
      }
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
     * Validate Data
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
    validateData(e) {

      console.log(e)





      // Object.keys(formData)

    },

    /**
     * On Submit
     * 
     * This method handles the submission of the form in this component. 
     * The form data is bubbled up to the parent component, where the API
     * client does the outbound request to the backend. 
     * 
     * The response will be passed back through props if there is an error;
     * otherwise the view is reloaded and the list of products is displayed.
     */
    onSubmit() {

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
      const val = e.val
      const key = e.key
      const newAttr = {}
      newAttr[key] = val
      this.form.attributes.push(newAttr)
    },

    /**
     * Get Last Inserted Id 
     * 
     * This method returns the last inserted product's ID from the database 
     * table. It uses the actionIndex endpoint and selects the last item
     * from the result set. If the result set is empty, it returns 0.
     * 
     * @return int lastId
     */
    async getLastInsertedId() {

      const response = await this.$http.get('product?size=1')

      console.log(response)

    }

  },
  mounted() {

    // this.$http.get('product/create')

  }
};
</script>

<style lang="css" scoped>

.product-add {
  background-color: #fff;
  padding: 42px;
}

.product-add p {
  text-align: left;
}

</style>
