import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import mdiVue from 'mdi-vue/v3'
import * as mdijs from '@mdi/js'

const appName = import.meta.env.VITE_APP_NAME || 'Centralized';

const themeVariables = {
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(mdiVue, {
                icons: mdijs
              })
            .provide('themeVariables', themeVariables)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
