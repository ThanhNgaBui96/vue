<template>
  <div id="app">
    <loading ref="loading" />
    <component :is="layout" v-if="layout" />
  </div>
</template>

<script>
import Loading from './Loading'
export default {
  el: '#app',
  data: () => ({
    // pageLayout: null,
    defaultLayout: 'DefaultLayout',
    toast_counter: 0
  }),

  components: {
    Loading
  },

  mounted() {
    this.$loading = this.$refs.loading; 
  },

  computed: {
    /**
     * Set the application layout.
     *
     * @param {String} layout
     */
    layout() {
      return this.$route.meta.layout || this.defaultLayout;
    }
  }
}
</script>
<style lang="scss">
  html, body, #app {
    height: 100%;
    margin: 0;
  }
  .full-height {
    min-height: 100%;
    background: #e4e5e6;
  }
</style>