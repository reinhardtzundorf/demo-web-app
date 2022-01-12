<template>
  <div id="app">
    <LayoutDefault>
      <template #title>{{ active.title }}</template>
      <template #main>
          <component :is="active.component" @updateUi="changeView(e)"></component>
      </template>
      <template #sidebar>
        <ProductControls @updateUi="val => changeView(val)"></ProductControls>
      </template>
    </LayoutDefault>
  </div>
</template>

<script>

/**
 * Utils, helpers
 */
import { capitalize } from 'lodash'

/**
 * Layout 
 */
import LayoutDefault from './components/layout/LayoutDefault.vue'

/**
 * Product
 */
import ProductControls from './components/product/ProductControls.vue'
import ProductList from './components/product/ProductList.vue'
import ProductAdd from './components/product/ProductAdd.vue'

/**
 * APP COMPONENT
 */
export default {
  name: 'App',
  components: {
    LayoutDefault,
    ProductControls,
    ProductList,
    ProductAdd
  },
  data() {
    return {
      active: {
        component: "ProductList",
        title: "List Products"
      }
    };
  },
  methods: {
    changeView(e) {
      const actionType = capitalize(e.type)
      const actionPrefix = capitalize(e.action)
      this.active.component = actionType + actionPrefix
      this.active.title = actionPrefix + " " + actionType
    }
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  width: 100%;
  height: 100%;
  background-color: #efefef;
}
</style>
