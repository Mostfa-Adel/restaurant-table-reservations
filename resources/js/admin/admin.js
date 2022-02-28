import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import en from "vee-validate/dist/locale/en";    
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue-js-modal'
import Vue from 'vue';
import VueTimepicker from 'vue2-timepicker'

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

Vue.component('multiselect', Multiselect);
// Vue.use(VeeValidate, {strict: true});
Vue.use(VeeValidate, {
    dictionary: {
      en: {
        messages: en.messages,
        attributes: { employee_number: "Employee Number" }
      }
    }
  });
Vue.component('datetime', flatPickr);
Vue.component('vtimepicker', VueTimepicker);
Vue.use(VModal, { dialog: true, dynamic: true, injectModalsContainer: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);

new Vue({
    mixins: [Admin],
});