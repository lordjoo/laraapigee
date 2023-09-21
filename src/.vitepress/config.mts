import {defineConfig} from 'vitepress'
import {sidebar} from "./sidebar";

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "LaraApigee",
    description: "LaraApigee documentation",
    head: [['link', { rel: 'icon', href: '/logo.svg' }]],
    themeConfig: {
        logo: '/logo.svg',
        // https://vitepress.dev/reference/default-theme-config

        nav: [
            {text: 'Home', link: '/'},
            {text: 'Examples', link: '/markdown-examples'}
        ],
        sidebar: sidebar,
        socialLinks: [
            {icon: 'github', link: 'https://github.com/vuejs/vitepress'}
        ]
    }
})
