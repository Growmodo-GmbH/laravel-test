import axios from "axios";

const axiosClient = axios.create({
  baseURL: '/api/v1'
})

const token = sessionStorage.getItem('TOKEN');

axiosClient.interceptors.request.use(config => {
  config.headers.Authorization = `Bearer ${token}`

  return config;
})

export default axiosClient;
