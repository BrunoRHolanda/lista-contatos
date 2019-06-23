import Vue from 'vue';

import API from '@config/routes-api';

class ContactsService {
    static index(callback) {
        Vue.http.get(API.resources.contacts)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }

    static store(contact, callback) {
        Vue.http.post(API.resources.contacts, contact)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }

    static update(contact, callback) {
        Vue.http.put(`${API.resources.contacts}/${contact.id}`, contact)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }

    static delete(contact, callback) {
        Vue.http.delete(`${API.resources.contacts}/${contact.id}`)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }
}

export default ContactsService;
