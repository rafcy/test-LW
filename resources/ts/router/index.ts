import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import Home from '@/pages/Home.vue';
import Leads from '@/pages/Leads.vue';

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/leads',
        name: 'leads',
        component: Leads
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
