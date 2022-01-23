import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Users from '../components/Users';
import AddUser from '../components/AddUser';
import EditUser from '../components/EditUser';

import Agents from '../components/Agents';
import AddAgent from '../components/AddAgent';
import EditAgent from '../components/EditAgent';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'users',
        path: '/users',
        component: Users
    },
    {
        name: 'adduser',
        path: '/users/add',
        component: AddUser
    },
    {
        name: 'edituser',
        path: '/users/edit/:id',
        component: EditUser
    },
    {
        name: 'agents',
        path: '/agents',
        component: Agents
    },
    {
        name: 'addagent',
        path: '/agents/add',
        component: AddAgent
    },
    {
        name: 'editagent',
        path: '/agents/edit/:id',
        component: EditAgent
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
