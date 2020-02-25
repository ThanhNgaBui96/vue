import Vue from 'vue';
import Meta from 'vue-meta';
import store from '~/store';
import router from '~/router';
import i18n from '~/plugins/i18n';
import App from '~/components/App.vue';
import BootstrapVue from 'bootstrap-vue';
import '~/plugins';
import axios from 'axios';

import { extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import { messages } from 'vee-validate/dist/locale/vi.json';
Object.keys(rules).forEach(rule => {
  extend(rule, {
    ...rules[rule], // copies rule configuration
    message: messages[rule] // assign message
  });
});

Vue.use(Meta);
Vue.use(BootstrapVue);

// register layouts
// const files = require.context('./layouts', true, /\.vue$/i);
// files.keys().map(key => Vue.component(files(key).name, files(key)));
import DefaultLayout from "~/layouts/DefaultLayout.vue";
Vue.component("DefaultLayout", DefaultLayout);

new Vue({
  i18n,
  store,
  router,
  ...App
});