<template>
    <div>
        <b-button v-for="item in actions" v-on:click="actionClicked(item.action)" v-bind:key="item.action">{{ item.text }}</b-button>
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
</style>
