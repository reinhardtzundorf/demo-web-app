<template>
    <div class="product-list">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>SKU</th>
                    <th>Attributes</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" v-bind:key="product.sku">
                    <td>{{ index + 1 }}</td>
                    <td>{{ product.sku }}</td>
                    <td>{{ product.attributes }}</td>
                    <td>View</td>
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
        this.$http.get('/product')
                  .then(response => {
                     this.response = response
                     this.products = this.response.data
                  })
    }
};

</script>

<style lang="css" scoped>

.product-list {
    background-color: #fff;
    box-shadow: 0px 0px 4px 8px rgba(0,0,0,0.0425);
    padding: 24px;
    margin: 24px;
}

</style>
