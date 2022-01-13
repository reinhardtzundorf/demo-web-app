<template>
    <div class="product-list">

        <!-- WELCOME -->
        <LayoutSection>
            <template #title>Welcome!</template>
            <template #subtitle>This is a simple Vue app which manages products using a back-end API.</template>
        </LayoutSection>

        <!-- TABLE -->
        <LayoutSection>
            <template #title>Welcome!</template>
            <template #subtitle>This is a basic HTML table that displays the list of products to the user.</template>
            <template #body>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product) in products" v-bind:key="product.sku" class="product-list-item">
                            <td>{{ product.sku }}</td>
                            <td>
                                <table class="table table-borderless ">
                                    <tbody>
                                        <tr v-for="(v, k, idx) in product.attributes" v-bind:key="idx">
                                            <td>{{ k }}</td>
                                            <td>{{ v }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
        </LayoutSection>

    </div>
</template>

<script>

import LayoutSection from '@/components/layout/LayoutSection.vue'

export default {
  name: 'ProductList',
  components: {
    LayoutSection
  },
  data() {
    return {
      response: null,
      products: []
    };
  },
  mounted() {
    this.$http.list()
      .then(response => {
         this.response = response
         this.products = this.response.data
      })
  }
};

</script>

<style lang="css" scoped>

.product-list {
  
}

 table {
  font-size: 12px;
  color: #444;
  border-color: #666;
}

table th {
  border-color: #666;
}

.product-list-item {
    background-color: #fff;
    border-top: 4px solid #efefef;
    border-bottom: 4px solid #efefef;
    border-left: 1px solid #efefef;
    border-right: 1px solid #efefef;
}

</style>
