import Vue from 'vue'
import VueRouter from 'vue-router';
import Login from '../Views/Auth/Login'
import Template from '../Views/Template';
import ListCourse from '../Views/Course/Index';
import CreateCourse from '../Views/Course/Form';
import ListQuestion from '../Views/Question/Index';
import Form from '../Views/Question/Form';
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/',
            name: 'template',
            component: Template,
            children: [
                {
                    path: '/course',
                    name: 'course',
                    component: ListCourse
                },
                {
                    path: '/create',
                    name: 'create-course',
                    component: CreateCourse
                },
                {
                    path: '/question',
                    name: 'question',
                    component: ListQuestion
                },
                {
                    path: '/form',
                    name: 'form',
                    component: Form
                },
            ]
        },
    ],
});
export default router;
