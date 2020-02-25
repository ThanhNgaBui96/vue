function page (path) {
  return () => import(`~/pages/${path}`).then(m => m.default || m)
}

export default [
  {
    path: '/',
    meta: {
      layout: 'DefaultLayout'
    },
    component: {
      render(c) {
        return c('router-view')
      }
    },
    children: [
      {
        path: 'app',
        name: 'app.index',
        meta: {
          layout: 'DefaultLayout'
        },
        component: page('index.vue')
      },
      {
        path: '/app/login',
        name: 'app.login',
        meta: {
          layout: 'DefaultLayout'
        },
        component: page('login.vue')
      }
    ]
  },
]