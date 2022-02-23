import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import VModal from "vue-js-modal";
import AdminForm from "./components/AdminForm";
import Vuetable from 'vuetable-2/src/components/Vuetable';

Vue.use(VModal);
Vue.use(BootstrapVue);
Vue.component("vuetable", Vuetable);

new Vue({
    el: "#app-package-test-admin",
    components: { adminterface: AdminForm }
});
