import Vue from 'vue';
import VueResource from 'vue-resource';

Vue.use(VueResource);

Vue.http.options.root = '/api';
// Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk';