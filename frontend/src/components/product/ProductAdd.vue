<template>
    <div class="product-add">
        <b-form>
            <b-container>
                <form class="mt" @submit.prevent="login">
                  <b-alert class="alert-sm" :variant="responseSuccess ? 'success' : 'danger'" v-if="responseMessage">
                    {{ responseMessage }}
                  </b-alert>
                  <div class="form-group">
                    <input class="form-control no-border" ref="email" required type="email" name="email" placeholder="Email" />
                  </div>
                  <div class="form-group">
                    <input class="form-control no-border" ref="password" required type="password" name="password" placeholder="Password" />
                  </div>
                  <b-button type="submit" size="sm" class="auth-btn mb-3" variant="info">{{this.isFetching ? 'Loading...' : 'Login'}}</b-button>
                  <p class="widget-auth-info">or sign in with</p>
                  <div class="social-buttons">
                    <b-button @click="googleLogin" variant="primary" class="social-button mb-2">
                      <i class="social-icon social-google"></i>
                      <p class="social-text">GOOGLE</p>
                    </b-button>
                    <b-button @click="microsoftLogin" variant="success" class="social-button">
                      <i class="social-icon social-microsoft"></i>
                      <p class="social-text">MICROSOFT</p>
                    </b-button>
                  </div>
                </form>
                <p class="widget-auth-info">
                  Don't have an account? Sign up now!
                </p>
            </b-container>
        </b-form>
    </div>
</template>

<script>
export default {

  name: 'ProductList',

  data() {
    return {
      responseMessage: null,
      responseSuccess: null
    };
  },
  props: {
    data: {
        type: Array,
        required: true
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
     * @param object $formData
     * @return array|true
     */
    validateData(formData) {

      Object.keys(formData)

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

    }

  },
  mounted() {

    // this.$http.get('product/create')

  }
};
</script>

<style lang="css" scoped>

.product-add {

}

.product-add p {
  text-align: left;
}

</style>
