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
            <div class="form-section-title">Product Information</div>
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
            </b-form-group>
          </div>
        </div>

        <!-- PRODUCT ATTRIBUTES -->
        <div class="form-section">
          <div class="form-row">
            <div class="form-section-title">Product Attributes</div>
            <div class="form-section-subtitle">Please add some attributes to your product to describe it.</div>
          </div>
          <div class="form-row" v-if="form.attributes.length > 0">
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
                        <th colspan="2">{{index+1}}</th>
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
            <div class="form-section-title">Add An Attribute</div>
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
            <div class="form-section-title">Create Product</div>
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

import _ from 'lodash'
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
        attributes: [
          {
            key: "attr1",
            val: "val1"
          },
          {
            key: "attr2",
            val: "val2"
          }
        ]
      },
      postData: {},
      isDebugMode: true,
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

      // let productObject = {}

      // productObject.sku = this.form.sku
      // productObject.attributes = {}

      // this.form.attributes.forEach((attribute) => {
      //   productObject.attributes[attribute.key] = attribute.val
      // })

      let attr = this.form.attributes 

      _.transform(attr, (r,c,k) => r.push({[k]:c}), [])

      console.log(attr)

      let newAttrObject = {}
      this.form.attributes.forEach((arrayItem) => {
        newAttrObject[arrayItem.key] = arrayItem.val
      })

      this.$http.createProduct({sku: this.form.sku, attributes: newAttrObject})
                .then((response) => {
                  if(response.status === 201) {
                    alert("created");
                    this.$emit('onCreated', response.data)
                  }
                  this.postData = response
                })
                .catch(error => {
                  alert(error)
                  console.log(error)
                })
                .finally(() => {
                  alert("finally")
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
      alert(e);
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
      // const response = await this.$http.get('product')
      // const items = response.data.data
      // const length = items.length
      // alert(items[length])
      // console.log(response)
    }

  },
  async mounted() {
    // 

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
