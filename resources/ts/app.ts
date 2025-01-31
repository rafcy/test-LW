import './bootstrap';
import { createApp } from 'vue';
import { getFileNameFromPath } from './helpers';
import router from './router';
import App from './App.vue';
import 'virtual:svg-icons-register'


const app = createApp(App);

Object.entries(import.meta.glob('./components/**/*.vue', { eager: true }))
  .forEach(([path, definition]) => {
    console.log(getFileNameFromPath(path), definition);
    app.component(getFileNameFromPath(path), definition.default);
  });

app.use(router);
app.mount('#app');

