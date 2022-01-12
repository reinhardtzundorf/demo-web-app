<template>
    <div class="default-layout">
        <b-container>
            <b-row>
                <b-col lg="8">
                    <h1><slot name="title"></slot></h1>
                </b-col>
            </b-row>
            <b-row>
                <b-col lg="8">
                    <div class="default-main">
                        <slot name="main">
                            <!-- main content area.. -->
                        </slot>
                    </div>
                </b-col>
                <b-col lg="4">
                    <div class="default-sidebar">
                        <slot name="sidebar">
                            <!-- navigation/sidebar -->
                        </slot>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
  name: 'LayoutDefault',
  data () {
    return {

    }
  },
  mounted() {
    
  }
};
</script>

<style lang="css" scoped>

.default-layout {
    /*width: 1080px;*/
    /*height: 550px;*/
    width: 100%;
    height: 100%;
    display: flex;
}

.default-sidebar {
    display: inline-flex;
    padding: 42px;
    width: 200px;
    height: 550px;
    background-color: #efefef;
}

.default-sidebar p {
    display: inline-flex;
    font-size: 20px;
}

.default-layout h1 {
    margin-top: 32px;
}

</style>