<template>
    <div class="product-controls">
        <b-list-group>
          <b-list-group-item href="#" v-for="item in actions" v-on:click="actionClicked(item.action)" v-bind:key="item.action">{{ item.text }}</b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
export default {
  name: 'ProductControls',
  data() {
    return {
        actions: [
            {action: 'list', text: 'List Products'},
            {action: 'add', text: 'Add Product'}
        ]
    };
  },
  methods: {
    actionClicked(e) {
        this.$emit('updateUi', {
            action: e,
            type: 'product'
        })
    }
  }
};
</script>

<style lang="css" scoped>

.product-controls {
    min-width: 275px;
    height: 400px;
    background-color: rgba(255, 255, 255, 0.4);
}

</style>
