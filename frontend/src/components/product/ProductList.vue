<template>
    <div class="product-list">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>SKU</th>
                    <th>Attributes</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" v-bind:key="product.sku">
                    <td>{{ index }}</td>
                    <td>{{ product.sku }}</td>
                    <td>
                        <table class="table table-borderless ">
                            <tbody>
                                <tr v-for="(v, k, idx) in product.attributes" v-bind:key="idx">
                                    <td colspan="2">{{ k }}</td>
                                    <td colspan="1">{{ v }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    name: 'ProductList',
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
    background-color: rgba(255, 255, 255, 1);
    box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.05);
    padding: 48px;
    /*margin: 24px;*/
}

 table {
  font-size: 12px;
  color: #444;
  border-color: #666;
}

table th {
  border-color: #666;
}

</style>
