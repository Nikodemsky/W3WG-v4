{
    consentModal: {
        title: 'My website is using cookies',
        description: 'W3WF is using cookies to help users navigate efficiently and perform certain functions.',
        acceptAllBtn: 'Accept everyting',
        acceptNecessaryBtn: 'Reject everything',
        showPreferencesBtn: 'Manage Individual preferences',
        // closeIconLabel: 'Reject all and close modal',
        footer: `<a href="https://w3wg.com/privacy-policy/" rel="privacy-policy" target="_blank">Privacy Policy</a>`,
    },
    preferencesModal: {
        title: 'Manage cookie preferences',
        acceptAllBtn: 'Accept everyting',
        acceptNecessaryBtn: 'Reject everything',
        savePreferencesBtn: 'Accept current selection',
        closeIconLabel: 'Close modal',
        serviceCounterLabel: 'Service|Services',
        sections: [
            {
                title: 'Your Privacy Choices',
                description: `Here you can change configuration of specific cookies or data processing.`,
            },
            {
                title: 'Strictly Necessary',
                description: 'These cookies are essential for the proper functioning of the website and cannot be disabled.',

                //this field will generate a toggle linked to the 'necessary' category
                linkedCategory: CAT_NECESSARY,
                cookieTable: {
                    caption: 'Table with list of cookies used on W3WG',
                    headers: {
                        name: 'Cookie name',
                        domain: 'Domain',
                        expires: 'Expiration',
                        desc: 'Description'
                    },
                    body: [
                        {
                            name: 'cc_cookie',
                            domain: location.hostname,
                            expires: '365 days',
                            desc: 'A cookie that remembers the user\'s preferences regarding selected processing consents.',
                        },
                        {
                            name: 'vm-mode',
                            domain: location.hostname,
                            expires: '1 year and two days',
                            desc: 'A cookie that saves the user\'s selected visual mode (light/dark).',
                        },
                        {
                            name: 'w3wg_a-fz',
                            domain: location.hostname,
                            expires: '1 year and 4 days',
                            desc: 'A cookie that saves the selected website font size for the user.',
                        }
                    ]
                }
            },
            {
                title: 'Analytics',
                description: 'These cookies will collect information about how you browse the website. All data is anonymized and cannot be used to identify you.',
                linkedCategory: CAT_ANALYTICS,
                cookieTable: {
                    caption: 'Table with list of cookies used on W3WG',
                    headers: {
                        name: 'Cookie name',
                        domain: 'Domain',
                        expires: 'Expiration',
                        desc: 'Description'
                    },
                    body: [
                        {
                            name: '_ga',
                            domain: location.hostname,
                            expires: '1 year and 4 days',
                            desc: 'Contains a unique identifier used by Google Analytics 4 to determine that two distinct hits belong to the same user across browsing sessions',
                        },
                        {
                            name: '_gid',
                            domain: location.hostname,
                            expires: '1 day',
                            desc: 'Contains a unique identifier used by Google Analytics to determine that two distinct hits belong to the same user across browsing sessions.',
                        }
                    ]
                }
            },
            {
                title: 'More information',
                description: 'For more information about the privacy policy or cookie management on the website <a href="mailto:&#105;&#110;&#102;&#111;&#64;&#119;&#51;&#119;&#103;&#46;&#99;&#111;&#109;">contact me directly via e-mail.</a>'
            }
        ]
    }
}