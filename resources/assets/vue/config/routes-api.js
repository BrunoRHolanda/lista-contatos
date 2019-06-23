
module.exports = {
    root: '/api',
    auth: {
        login: { url: 'auth/login', method: 'POST'},
        me: { url: 'auth/me', method: 'GET'},
        refresh: { url: 'auth/refresh', method: 'GET'},
    },
};