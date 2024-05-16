// router.js
import { createRouter, createWebHistory } from 'vue-router'
import MyComponent from './components/MyComponent.vue'
import HelloWorld from './components/HelloWorld.vue'

const routes = [
    { path: '/', component: HelloWorld },
    { path: '/my-component', component: MyComponent }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router