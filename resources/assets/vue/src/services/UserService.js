import Vue from 'vue';

import API from '@config/routes-api';

class UserService {
    static index(callback) {
        Vue.http.get(API.resources.users)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }

    static store(user, callback) {
        Vue.http.post(API.resources.users, user)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }

    static update(user, callback) {
        Vue.http.put(`${API.resources.users}/${user.id}`, user)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }

    static delete(user, callback) {
        Vue.http.delete(`${API.resources.users}/${user.id}`)
            .then((response) => callback(response, null), (error) => callback(null, error));
    }
}

export default UserService;
