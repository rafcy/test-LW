import './bootstrap';
import { createApp } from 'vue';
import { getFileNameFromPath } from './helpers';
import router from './router';
import App from './App.vue';
import 'virtual:svg-icons-register'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

const toastOptions = {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: false
};

app.use(Toast, toastOptions);

Object.entries(import.meta.glob('./components/**/*.vue', { eager: true }))
  .forEach(([path, definition]) => {
    app.component(getFileNameFromPath(path), definition.default);
  });

app.use(router);

app.mount('#app');

