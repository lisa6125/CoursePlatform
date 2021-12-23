import Home from './vue/view/Home';
// import About from './components/About';
// import trypage from './components/try';
// import campaign from './components/campaign';
// import Register from './components/Register';
// import Login from './components/Login';
// import Dashboard from './components/Dashboard';
import NotFound from './vue/view/NotFound';


export default{
    mode: 'history',
    linkActiveClass: 'font-semibold',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home,
            name: "Home"
        },
        // {
        //     path: '/trypage',
        //     component: trypage
        // },
        // {
        //     path: '/campaign',
        //     component: campaign
        // },
        // {
        //     path: '/about',
        //     component: About
        // },
        // {
        //     path: '/register',
        //     component: Register
        // },
        // {
        //     path: '/login',
        //     component: Login,
        //     name: 'Login'
        // },
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
    ]
}