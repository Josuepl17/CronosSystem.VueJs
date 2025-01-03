
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Link } from '@inertiajs/vue3'; // importei o componenete 
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { useForm } from '@inertiajs/vue3';
import Layout from './Layouts/Layout.vue';
import { onMounted } from 'vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Layout', Layout)
            .component('useForm', useForm)
            .component('Link', Link ) // registrei o componente Link do imnertia 
            .use(ZiggyVue)
            .mount(el);
    
    },
    progress: {
        color: 'red',
    },
});
