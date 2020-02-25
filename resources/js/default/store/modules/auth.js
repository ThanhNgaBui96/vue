import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  login_res: null,
  logout_res: null,
  user: null,
  token_user: Cookies.get('token_user'),
  fetch_user_res: null
};

// getters
export const getters = {
  login_res: state => state.login_res,
  logout_res: state => state.logout_res,
  user: state => state.user,
  token_user: state => state.token_user,
};

// mutations
export const mutations = {
  [types.LOGIN](state, res) {
    state.token_user = res.token;
    state.login_res = res;
    Cookies.set('token_user', res.token, { expires: res.remember ? 365 : res.expires_in / 86400 });
  },
  [types.FETCH_USER](state, res) {
      state.user = res;
  },
  logout(state) {
    Cookies.remove('token_user');
  }
}

// actions
export const actions = {
  async login({ commit }, params) {
    const { data } = await axios.post('/api/login', params).then(rs => rs).catch(err => {
      // Default error
      return {'data': {'error': {'code': '5001', 'msg': err}}};
    });
    commit(types.LOGIN, data);
  },
  async fetchUser({ commit }) {
    const { data } = await axios.post('/api/user').then(rs => rs).catch(err => {
      // Default error
      return {'data': {'error': {'code': '5001', 'msg': err}}};
    });

    commit(types.FETCH_USER, data);
  },
  async logout({ commit }) {
    const { data } = await axios.post('/api/logout').then(rs => rs).catch(err => {
      // Default error
      return {'data': {'error': {'code': '5001', 'msg': err}}};
    });
    commit('logout')
  }
}
