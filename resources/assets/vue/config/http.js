import Vue from 'vue';
import RoutesApi from './routes-api';

Vue.http.options.root = RoutesApi.root;
