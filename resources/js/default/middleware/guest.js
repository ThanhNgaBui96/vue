import store from '~/store'

export default (to, from, next) => {
  const name = to.name;
  if (!store.getters['auth/user']) {
    if (name.includes('login')) {
      next()
    } else {
      next({ name: 'app.login' })
    }
  } else {
    console.log('1')
    if (name.includes('login')) {
      next({ name: 'app.index' })
    } else {
      next()
    }
  }
}
