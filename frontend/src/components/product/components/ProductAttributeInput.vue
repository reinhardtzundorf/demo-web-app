<template>
  <b-container fluid class="form-attribute-input">
    <form class="mt" @submit.prevent="bubbleValue">
      <b-row>
        <b-col lg="5">
          <b-form-group
            id="input-group-1"
            label-for="input-1"
          >
          <b-form-input
            class="form-input-attr"
            id="attribute"
            v-model="form.attribute"
            type="text"
            placeholder="Attribute name"
            required
          >
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="5">
        <b-form-group
          id="input-group-2"
          label-for="input-2"
        >
          <b-form-input
            class="form-input-attr"
            id="value"
            v-model="form.value"
            type="text"
            placeholder="Attribute value"
            required
          >
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="2">
        <b-form-group
          id="input-group-3"
          label-for="input-3"
        >
            <b-button variant="secondary" size="sm" type="submit">Add</b-button>
        </b-form-group>
      </b-col>
      </b-row>
    </form>
  </b-container>
</template>

<script>
export default {
  name: 'ProductAttributeInput',
  data() {
    return {
      form: {
        attribute: null,
        value: null,
      },
    };
  },
  mounted() {
    if(this.formName !== null || !isNaN(this.formName)) {
      this.form.attribute = this.formName
    }
    if(this.formValue !== null || !isNaN(this.formValue)) {
      this.form.value = this.formValue
    }
  },
  props: {
    id: {
      type: Number,
      default: 1,
      required: false
    },
    formName: {
      type: String,
      required: false
    },
    formValue: {
      type: String,
      required: false
    }
  },
  methods: {
    validateField(val) {
      if(val === undefined || isNaN(val) || val === "") {
          return false
      } else {
          return true
      }
    },
    bubbleValue() {
      this.$emit('createAttribute', {
          key: this.form.attribute,
          val: this.form.value
      })
    }
  }
};
</script>

<style lang="css" scoped>

.form-attribute-input {
    margin-top: 12px;
    margin-bottom: 12px;
    background-color: #fff;
    padding: 4px;
    padding-top: 8px;
}

.form-index {
    padding-top: 6px;
}

.form-input-attr {
    font-size: 12px;
    
}

</style>
