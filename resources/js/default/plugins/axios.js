import axios from 'axios';
import store from '~/store';
import i18n from '~/plugins/i18n';

// Request interceptor
axios.interceptors.request.use(request => {
  var token = null;
  var url = request.url;

  token = store.getters['auth/token_user']


  if (token) {
    request.headers.common['Authorization'] = `Bearer ${token}`
  }

  const locale = null;
  if (locale) {
    request.headers.common['Accept-Language'] = locale
  }

  return request
})

// Response interceptor
axios.interceptors.response.use(response => response, error => {
  const { status, config } = error.response;
  
  return Promise.reject(error)
})