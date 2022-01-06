import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Home from './vue/view/Home';
import Course from './vue/view/Course';

// import About from './components/About';
// import trypage from './components/try';
// import campaign from './components/campaign';
import Register from './vue/view/Register';
import Login from './vue/view/Login';
import NotFound from './vue/view/NotFound';

import AdminDashboard from './vue/view/admin/AdminDashboard.vue';
import CreateCourse from './vue/view/admin/CreateCourse.vue';
import CreateGroup from './vue/view/admin/CreateGroup.vue';
import AdminGroup from './vue/view/admin/AdminGroup.vue';
import AdminUser from './vue/view/admin/AdminUser.vue';
import Profile from './vue/view/admin/Profile.vue';


const routes = [
    {
        path: '*',
        component: NotFound,
        meta: {
        title: 'error',
        },
    },
    {
        path: '/',
        component: Home,
        name: "Home",
        meta: {
        title: '首頁',
        },
    },
    {
        path: '/course',
        component: Course,
        name: "Course",
        meta: {
        title: '課程列表',
        },
    },
    {
        path: '/register',
        component: Register,
        meta: {
        title: '註冊',
        },
    },
    {
        path: '/login',
        component: Login,
        name: 'Login',
        meta: {
        title: '登入',
        },
    },
    {
        path: '/adminpage',
        name: 'AdminDashboard',
        component: AdminDashboard,
        meta: {
        title: '後台管理',
        },
        children: [
            {
                path: '/',
                name: 'Profile',
                component:Profile,
                meta: {
                title: '用戶資料',
                }
            },
            {
                path: '/adminpage/createcourse',
                name: 'CreateCourse',
                component:CreateCourse,
                meta: {
                title: '課程管理',
                }
            },
            {
                path: '/adminpage/creategroup',
                name: 'CreateGroup',
                component:CreateGroup,
                meta: {
                title: '我的開團',
                }
            },
            {
                path: '/adminpage/adminGroup',
                name: 'AdminGroup',
                component:AdminGroup,
                meta: {
                title: '開團管理',
                }
            },
            {
                path: '/adminpage/adminuser',
                name: 'AdminUser',
                component:AdminUser,
                meta: {
                title: '用戶管理',
                }
            },
        ],
        // beforeEnter: (to, form, next) =>{
        //    axios.get('/api/athenticated').then(()=>{
        //        next()
        //    }).catch(()=>{
        //        return next({ name: 'Login'})
        //    })
        // }
    }
]
const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'font-semibold',
    scrollBehavior () {
    return { x: 0, y: 0 }
  }
})
router.afterEach((to, from) => {
  let title = ''
  title = to.meta.title
  document.title = title
})
        // {
        //     path: "/dashboard",
        //     name: "Dashboard",
        //     component: Dashboard,
        //    beforeEnter: (to, form, next) =>{
        //        axios.get('/api/athenticated').then(()=>{
        //            next()
        //        }).catch(()=>{
        //            return next({ name: 'Login'})
        //        })
        //    }
       
        //   }
export default router