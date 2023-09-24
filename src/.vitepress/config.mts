import {defineConfig} from 'vitepress'
import {sidebar} from "./sidebar";

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "LaraApigee",
    base: '/laraapigee',
    description: "LaraApigee documentation",
    head: [['link', { rel: 'icon', href: '/logo.svg' }]],
    themeConfig: {
        logo: '/logo.svg',
        // https://vitepress.dev/reference/default-theme-config
        nav: [
            {text: 'Home', link: '/'},
            {text: 'Getting Started', link: '/getting-started'},
            {text: 'API Reference', link: '/api/edge/'},
        ],
        sidebar: sidebar,
        socialLinks: [
            {icon: 'github', link: 'https://github.com/vuejs/vitepress'}
        ],
        footer: {
            message: 'Released under the MIT License.',
            copyright: 'Copyright © 2023 Youssef Afify'
        },
        outline: {
            level: "deep"
        }
    }
})
