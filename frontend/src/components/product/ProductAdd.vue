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
    }
  },
  mounted() {

    this.$http.get('product/create')

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
