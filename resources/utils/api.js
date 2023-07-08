import axios from 'axios';

const instance = axios.create();

// Use an interceptor to set the Authorization header dynamically for each request
instance.interceptors.request.use(function (config) {
    const accessToken = localStorage.getItem('access_token');
    config.headers.Authorization = accessToken ? `Bearer ${accessToken}` : '';
    return config;
});

const api = {
    login(data) {
        return instance.post('/api/login', data);
    },
    register(data) {
        return instance.post('/api/register', data);
    },
    logout() {
        return instance.post('/api/logout');
    },
    unsubscribe() {
        return instance.post('/api/unsubscribe');
    },
    users() {
        return instance.get('/api/users');
    },
    updateUser(user) {
        return instance.patch(`/api/users/${user.id}`, user);
    },
    deleteUser(user) {
        return instance.delete(`/api/users/${user.id}`);
    },
};

export default api;
