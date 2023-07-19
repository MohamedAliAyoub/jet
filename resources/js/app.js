import {createApp, h} from 'vue';
import {createInertiaApp, Head} from '@inertiajs/inertia-vue3';
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";
import {createI18n} from 'vue-i18n';

// PrimeVue library
import PrimeVue from 'primevue/config';
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';


//theme
import "primevue/resources/themes/lara-light-indigo/theme.css";
//core
import "primevue/resources/primevue.min.css";

// additional css
import '../css/_menu.scss';
import 'primeicons/primeicons.css';
import '../css/app-rtl.css';

// Global Components
import DashboardLayout from "@/Layout/Dashboard/Index.vue";
import RouterLink from "./Components/Global/RouterLink.vue";
import Column from "primevue/column";
import { ZiggyVue } from 'ziggy';


// language
import localeAr from './Locale/ar_php.js';
import localeEn from './Locale/en_php.js';

// directives
import { ability_if, ability_else } from "./ability_directive";

createInertiaApp({
    resolve: name => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
        page.then((module) => {
            module.default.layout = module.default.layout || DashboardLayout;
        });
        return page;
    },
    setup({el, app, props, plugin}) {
        const i18n = createI18n({
            legacy: false,
            locale: props.initialPage.props.locale,
            messages: {
                ar: localeAr,
                en: localeEn,
            }
        });

        let TheApp = createApp({render: () => h(app, props)})
            .use(plugin)
            .use(PrimeVue)
            .use(ConfirmationService)
            .use(ToastService)
            .use(ZiggyVue)
            .use(i18n)
            .component('Head', Head)
            .component('Column', Column)
            .component('router-link', RouterLink)
            .directive('ability', ability_if)
            .directive('else-ability', ability_else)
            .mixin(
                {
                    methods: {
                        asset(path) {
                            return props.initialPage.props.asset_url + '/' + path
                        }
                    }
                }
            )

            TheApp.mount(el)
    },
});


