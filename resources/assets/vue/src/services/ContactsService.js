import Vue from 'vue';

import API from '@config/routes-api';

class ContactsService {
    static index(callback) {
        Vue.http.get(API.resources.contacts)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }
}

export default ContactsService;
