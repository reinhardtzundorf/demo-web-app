<template>
  <div id="app">
    <b-container fluid class="page-title">
      <b-container>
        <h1>{{ active.title }}</h1>
      </b-container>
    </b-container>
    <LayoutDefault>
      <template #main>
          <component :is="active.component" @updateUi="val => changeView(val)"></component>
      </template>
      <template #sidebar>
        <ProductControls @updateUi="val => changeView(val)"></ProductControls>
      </template>
    </LayoutDefault>
    <b-container fluid class="page-footer">
      <b-container>
        <footer>Footer Content</footer>
      </b-container>
    </b-container>
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
  text-align: left;
  color: #2c3e50;
  width: 100%;
  height: 100%;
  background-color: #efefef;
}

.page-title {
  background-color: #fff;
  padding-top: 28px;
  padding-bottom: 28px;
  box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.05);
}

.page-footer {
  margin-top: 42px;
  padding-top: 20px;
  padding-bottom: 20px;
  background-color: rgba(0,0,0,0.0550);
  border-top: 2px solid #fff;
}

.page-footer footer {
  font-size: 12px;
  color: #444;
  text-align: center;
}

</style>
