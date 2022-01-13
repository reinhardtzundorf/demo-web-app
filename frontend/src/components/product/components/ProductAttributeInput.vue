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

  /**
   * Component Name
   */
  name: 'ProductAttributeInput',

  /**
   * Component State
   */
  data() {
    return {
      form: {
        attribute: null,
        value: null,
      },
    };
  },

  /**
   * Mounted 
   * 
   * This is the mounted() Vue lifecycle hook which is used to 
   * set up the local state variables from prop values passed 
   * down from the parent component.
   */
  mounted() {
    if(this.formName !== null || !isNaN(this.formName)) {
      this.form.attribute = this.formName
    }
    if(this.formValue !== null || !isNaN(this.formValue)) {
      this.form.value = this.formValue
    }
  },

  /**
   * Component Props
   * 
   * These are the props which may be used to pass the values
   * down from the parent component to this component's state.
   * 
   * @id
   * @formName
   * @formValue
   */
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

    /**
     * Validate Field
     * 
     * Basic required validation logic for the input fields.
     *
     * @param string val
     * @return boolean true|false
     */
    validateField(val) {
      if(val === undefined || isNaN(val) || val === "") {
          return false
      } else {
          return true
      }
    },

    /**
     * Bubble Value
     * 
     * This method wraps the Vue $emit function and sends the 
     * key and val of the form's inputs to the parent component
     * configured to listen to the createAttribute event.
     * 
     * @return void
     */
    bubbleValue() {
      
      this.$emit('createAttribute', {
          key: this.form.attribute,
          val: this.form.value
      })

      this.form.attribute = null
      this.form.value = null

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
