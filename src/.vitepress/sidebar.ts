export const sidebar = [
    {
        text: 'Getting Started',
        items: [
            {text: 'Installation', link: '/getting-started#installation'},
            {text: 'Configuration', link: '/getting-started#configuration'},
            {text: 'How to use', link: '/how-to-use'},
        ]
    },
    {
        text: 'API Reference',
        items: [
            {
                text: 'Apigee Edge',
                link: '/api/edge/',
                collapsed: true,
                items: [
                    {text: 'API Proxy', link: '/api/edge/api-proxy'},
                    {text: 'API Product', link: '/api/edge/api-product'},
                    {text: 'Developer', link: '/api/edge/developer'},
                    {text: 'Developer App', link: '/api/edge/developer-app'},
                    {text: 'Company', link: '/api/edge/company'},
                    {text: 'Company App', link: '/api/edge/company-app'},
                    {
                        text: 'Monetization',
                        link: '/api/edge/monetization/',
                        items: [
                            // {text: 'Rate Plan', link: '/api/edge/monetization/rate-plan'},
                        ]
                    },
                ]
            },
            {
                text: 'Apigee X',
                link: '/api/apigee/',
                items: []
            }
        ]
    }
];
