import store from '~/store'

export default async (to, from, next) => {
  const name = to.name;
  try {
    if (name.startsWith('app') && store.getters['auth/token_user']) {
      await store.dispatch('auth/fetchUser')
    }
  } catch (e) {}
    next()
}

