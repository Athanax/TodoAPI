import VueRouter from 'vue-router';

const routes =[
    {
        path: '/',
        name: 'home',
        component: require('./views/home.vue').default
    },
    {
        path: '/tasks',
        name: 'tasks',
        component: require('./views/tasks/index.vue').default
    },
    {
        path: '/tasks/:id',
        name:'task',
        component: require('./views/tasks/show.vue').default
    },
    {
        path: '/login',
        name:'login',
        component: require('./views/auth/login.vue').default
    },
    {
        path: '/register',
        name:'register',
        component: require('./views/auth/register.vue').default
    },
    {
        path: '/create',
        name:'create',
        component: require('./views/tasks/create.vue').default
    },
    {
        path: '/edit/:id',
        name:'edit',
        component: require('./views/tasks/edit.vue').default
    },
    
    
];

export default new VueRouter({
    mode: 'history',
    routes: routes,
    // linkActiveClass:'is-active',
    linkExactActiveClass: 'is-active'
})