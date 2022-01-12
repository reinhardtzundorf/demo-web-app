<template>
    <b-container fluid class="form-attribute-input">
        <form class="mt" @submit.prevent="bubbleValue">
            <b-row>
                <b-col lg="2">
                    <div class="form-index">
                        <p>{{ id }}</p>
                    </div>
                </b-col>
                <b-col lg="3">
                    <div class="form-group">
                        <div v-if="disabled">{{ form.attribute }}</div>
                        <input v-else class="form-control no-border" required type="text" v-model="form.attribute" placeholder="name" />
                    </div>
                </b-col>
                <b-col lg="3">
                    <div class="form-group">
                        <div v-if="disabled">{{ form.value }}</div>
                        <input v-else class="form-control no-border" required type="text" v-model="form.value" placeholder="value" />
                    </div>
                </b-col>
                <b-col lg="3">
                    <b-button v-if="!disabled" variant="primary" type="submit">Add</b-button>
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
        disabled: false
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
    bubbleValue(e) {
        console.log(e)
        this.$emit('createAttribute', {
            key: this.form.attribute,
            val: this.form.value
        })
        this.setDisabled()
    },
    setDisabled() {
        this.disabled = true
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

</style>
