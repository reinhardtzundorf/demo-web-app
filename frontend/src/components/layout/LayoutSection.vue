<template>
  <div class="layout-section">
    <div class="row">
      <div class="layout-section-title">
        <slot name="title"></slot>
      </div>
      <div :class="'layout-section-subtitle ' + (border ? 'border' : '')">
        <slot name="subtitle"></slot>
      </div>
    </div>
    <div class="row">
      <div class="layout-section-body">
        <slot name="body"></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  name: 'LayoutSection',

  data() {
    return {

    };
  },
  props: {
    border: {
      type: Boolean,
      default: false,
      required: false
    }
  }
};
</script>

<style lang="css" scoped>

.layout-section {
  background-color: #fff;
  padding: 24px;
  margin: 8px;
  box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.05);
  font-size: 14px;
}

.layout-section-title {
  font-size:  16px;
  font-weight: 700;
}

.layout-section-subtitle {
  font-size:  12px;  
  line-height: 2.0;
  margin-bottom: 18px;
}

.layout-section-subtitle .border {
  border-bottom: 0.5px solid #efefef;
}

.layout-section-body {

}

</style>
