import '../libs/cookieconsent.umd.js';

document.documentElement.classList.add('cc--darkmode');

// CMv2 vars
const CAT_NECESSARY = "necessary";
const CAT_ANALYTICS = "analytics";
const CAT_ADVERTISEMENT = "advertisement";
const CAT_FUNCTIONALITY = "functionality";
const CAT_SECURITY = "security";

const SERVICE_AD_STORAGE = 'ad_storage'
const SERVICE_AD_USER_DATA = 'ad_user_data'
const SERVICE_AD_PERSONALIZATION = 'ad_personalization'
const SERVICE_ANALYTICS_STORAGE = 'analytics_storage'
const SERVICE_FUNCTIONALITY_STORAGE = 'functionality_storage'
const SERVICE_PERSONALIZATION_STORAGE = 'personalization_storage'
const SERVICE_SECURITY_STORAGE = 'security_storage'

// Define dataLayer and the gtag function.
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}

// Set default consent to 'denied' (this should happen before changing any other dataLayer)
gtag('consent', 'default', {
    [SERVICE_AD_STORAGE]: 'denied',
    [SERVICE_AD_USER_DATA]: 'denied',
    [SERVICE_AD_PERSONALIZATION]: 'denied',
    [SERVICE_ANALYTICS_STORAGE]: 'denied',
    [SERVICE_FUNCTIONALITY_STORAGE]: 'denied',
    [SERVICE_PERSONALIZATION_STORAGE]: 'denied',
    [SERVICE_SECURITY_STORAGE]: 'denied',
});

/** 
 * Update gtag consent according to the users choices made in CookieConsent UI
 */
function updateGtagConsent() {
    gtag('consent', 'update', {
        [SERVICE_ANALYTICS_STORAGE]: CookieConsent.acceptedService(SERVICE_ANALYTICS_STORAGE, CAT_ANALYTICS) ? 'granted' : 'denied',
        [SERVICE_AD_STORAGE]: CookieConsent.acceptedService(SERVICE_AD_STORAGE, CAT_ADVERTISEMENT) ? 'granted' : 'denied',
        [SERVICE_AD_USER_DATA]: CookieConsent.acceptedService(SERVICE_AD_USER_DATA, CAT_ADVERTISEMENT) ? 'granted' : 'denied',
        [SERVICE_AD_PERSONALIZATION]: CookieConsent.acceptedService(SERVICE_AD_PERSONALIZATION, CAT_ADVERTISEMENT) ? 'granted' : 'denied',
        [SERVICE_FUNCTIONALITY_STORAGE]: CookieConsent.acceptedService(SERVICE_FUNCTIONALITY_STORAGE, CAT_FUNCTIONALITY) ? 'granted' : 'denied',
        [SERVICE_PERSONALIZATION_STORAGE]: CookieConsent.acceptedService(SERVICE_PERSONALIZATION_STORAGE, CAT_FUNCTIONALITY) ? 'granted' : 'denied',
        [SERVICE_SECURITY_STORAGE]: CookieConsent.acceptedService(SERVICE_SECURITY_STORAGE, CAT_SECURITY) ? 'granted' : 'denied',
    });
}

/**
 * All config. options available here:
 * https://cookieconsent.orestbida.com/reference/configuration-reference.html
 */
CookieConsent.run({

    root: 'body',
    autoShow: true,
    disablePageInteraction: true,
    hideFromBots: true,
    mode: 'opt-in',
    // revision: 0,

    cookie: {
        name: 'cc_cookie',
        domain: location.hostname,
        path: '/',
        sameSite: "Lax",
        expiresAfterDays: 365,
    },

    // https://cookieconsent.orestbida.com/reference/configuration-reference.html#guioptions
    guiOptions: {
        consentModal: {
            layout: 'box inline',
            position: 'bottom left',
            equalWeightButtons: true,
            flipButtons: false
        },
        preferencesModal: {
            layout: 'box',
            equalWeightButtons: true,
            flipButtons: false
        }
    },

    onFirstConsent: () => {
        updateGtagConsent();
    },
    onConsent: () => {
        updateGtagConsent();
    },
    onChange: () => {
        updateGtagConsent();
    },

/*     onFirstConsent: ({cookie}) => {
        console.log('onFirstConsent fired',cookie);
    },

    onConsent: ({cookie}) => {
        console.log('onConsent fired!', cookie)
    },

    onChange: ({changedCategories, changedServices}) => {
        console.log('onChange fired!', changedCategories, changedServices);
    },

    onModalReady: ({modalName}) => {
        console.log('ready:', modalName);
    },

    onModalShow: ({modalName}) => {
        console.log('visible:', modalName);
    },

    onModalHide: ({modalName}) => {
        console.log('hidden:', modalName);
    } ,*/

    categories: {
        [CAT_NECESSARY]: {
            enabled: true,  // this category is enabled by default
            readOnly: true  // this category cannot be disabled
        },
        [CAT_ANALYTICS]: {
            autoClear: {
                cookies: [
                    {
                        name: /^_ga/,   // regex: match all cookies starting with '_ga'
                    },
                    {
                        name: '_gid',   // string: exact cookie name
                    }
                ]
            },

            services: {
                [SERVICE_ANALYTICS_STORAGE]: {
                    label: 'Umożliwia lokalne zapisywanie ciastek powiązanych z analityką, w czasie wizyt.',
                }
            }

            // https://cookieconsent.orestbida.com/reference/configuration-reference.html#category-services
            /* services: {
                ga: {
                    label: 'Google Analytics',
                    onAccept: () => {},
                    onReject: () => {}
                },
                youtube: {
                    label: 'Youtube Embed',
                    onAccept: () => {},
                    onReject: () => {}
                },
            } */
        },
    },

    language: {
        default: 'pl',
        autoDetect: 'document',
        translations: {
            en: {
                consentModal: {
                    title: 'We use cookies',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                    acceptAllBtn: 'Accept all',
                    acceptNecessaryBtn: 'Reject all',
                    showPreferencesBtn: 'Manage Individual preferences',
                    // closeIconLabel: 'Reject all and close modal',
                    footer: `
                        <a href="#path-to-impressum.html" target="_blank">Impressum</a>
                        <a href="#path-to-privacy-policy.html" target="_blank">Privacy Policy</a>
                    `,
                },
                preferencesModal: {
                    title: 'Manage cookie preferences',
                    acceptAllBtn: 'Accept all',
                    acceptNecessaryBtn: 'Reject all',
                    savePreferencesBtn: 'Accept current selection',
                    closeIconLabel: 'Close modal',
                    serviceCounterLabel: 'Service|Services',
                    sections: [
                        {
                            title: 'Your Privacy Choices',
                            description: `In this panel you can express some preferences related to the processing of your personal information. You may review and change expressed choices at any time by resurfacing this panel via the provided link. To deny your consent to the specific processing activities described below, switch the toggles to off or use the “Reject all” button and confirm you want to save your choices.`,
                        },
                        {
                            title: 'Strictly Necessary',
                            description: 'These cookies are essential for the proper functioning of the website and cannot be disabled.',

                            //this field will generate a toggle linked to the 'necessary' category
                            linkedCategory: 'necessary'
                        },
                        {
                            title: 'Performance and Analytics',
                            description: 'These cookies collect information about how you use our website. All of the data is anonymized and cannot be used to identify you.',
                            linkedCategory: 'analytics',
                            cookieTable: {
                                caption: 'Cookie table',
                                headers: {
                                    name: 'Cookie',
                                    domain: 'Domain',
                                    desc: 'Description'
                                },
                                body: [
                                    {
                                        name: '_ga',
                                        domain: location.hostname,
                                        desc: 'Description 1',
                                    },
                                    {
                                        name: '_gid',
                                        domain: location.hostname,
                                        desc: 'Description 2',
                                    }
                                ]
                            }
                        },
                        {
                            title: 'Targeting and Advertising',
                            description: 'These cookies are used to make advertising messages more relevant to you and your interests. The intention is to display ads that are relevant and engaging for the individual user and thereby more valuable for publishers and third party advertisers.',
                            linkedCategory: 'ads',
                        },
                        {
                            title: 'More information',
                            description: 'For any queries in relation to my policy on cookies and your choices, please <a href="#contact-page">contact us</a>'
                        }
                    ]
                }
            },
            pl: {
                consentModal: {
                    title: 'W3WG korzysta z plików cookies',
                    description: 'Używamy plików cookie, aby pomóc użytkownikom w sprawnej nawigacji i wykonywaniu określonych funkcji.',
                    acceptAllBtn: 'Zaakceptuj wszystko',
                    acceptNecessaryBtn: 'Odrzuć wszystko',
                    showPreferencesBtn: 'Zarządzaj poszczególnymi opcjami',
                    // closeIconLabel: 'Reject all and close modal',
                    footer: `
                        <a href="#path-to-privacy-policy.html" target="_blank">Polityka prywatności</a>
                    `,
                },
                preferencesModal: {
                    title: 'Preferencje ciasteczek',
                    acceptAllBtn: 'Zaakceptuj wszystko',
                    acceptNecessaryBtn: 'Odrzuć wszystko',
                    savePreferencesBtn: 'Zapisz ustawienia',
                    closeIconLabel: 'Zamknij okno',
                    serviceCounterLabel: 'Service|Services',
                    sections: [
                        {
                            title: 'Twoje wybory',
                            description: `W tym miejscu możesz zmienić konfigurację poszczególnych ciasteczek lub przetwarzania twoich informacji.`,
                        },
                        {
                            title: 'Niezbędne',
                            description: 'Ciasteczka niezbedne do prawidłowego funkcjonowania strony, których nie można wyłączyć.',

                            //this field will generate a toggle linked to the 'necessary' category
                            linkedCategory: CAT_NECESSARY,
                            cookieTable: {
                                caption: 'Tabela z listą używanych ciastek',
                                headers: {
                                    name: 'Ciasteczko/Nazwa',
                                    domain: 'Domena',
                                    expires: 'Wygasa',
                                    desc: 'Opis'
                                },
                                body: [
                                    {
                                        name: 'cc_cookie',
                                        domain: location.hostname,
                                        expires: '365 dni',
                                        desc: 'Ciasteczko zapamiętujące preferencje użytkownika odnośnie wybranych zgód na przetwarzanie.',
                                    },
                                    {
                                        name: 'vm-mode',
                                        domain: location.hostname,
                                        expires: '1 rok i dwa dni',
                                        desc: 'Ciasteczko zapisujące wybrany tryb wizualny (jasny/ciemny) użytkownika.',
                                    },
                                    {
                                        name: 'w3wg_a-fz',
                                        domain: location.hostname,
                                        expires: '1 rok i cztery dni',
                                        desc: 'Ciasteczko zapisujące wybraną wielkość fonta witryny dla użytkownika.',
                                    }
                                ]
                            }
                        },
                        {
                            title: 'Analityka',
                            description: 'Te ciasteczka będą pobierać informacje o tym jak przeglądasz witrynę. Wszystkie dane są anonimozowane i nie mogą być użyte do twojej identyfikacji.',
                            linkedCategory: CAT_ANALYTICS,
                            cookieTable: {
                                caption: 'Tabela z listą używanych ciastek',
                                headers: {
                                    name: 'Ciasteczko/Nazwa',
                                    domain: 'Domena',
                                    expires: 'Wygasa',
                                    desc: 'Opis'
                                },
                                body: [
                                    {
                                        name: '_ga',
                                        domain: location.hostname,
                                        expires: '1 rok 1 miesiąc 4 dni',
                                        desc: 'Google Analytics ustawia ten plik cookie, aby zebrać dane dotyczące odwiedzających, sesji i kampanii oraz śledzić korzystanie przez użytkowników z witryny na potrzeby raportu analitycznego. Plik cookie przechowuje informacje w sposób zanonimizowany i przydziela użytkownikom losowo wygenerowany numer w celu identyfikacji odwiedzających.',
                                    },
                                    {
                                        name: '_gid',
                                        domain: location.hostname,
                                        expires: '1 dzień',
                                        desc: 'Google Analytics ustawia ten plik cookie w celu przechowywania informacji o sposobie korzystania z witryny przez odwiedzających oraz tworzenia raportu analitycznego dotyczącego wydajności witryny. Niektóre z gromadzonych danych dotyczą liczby odwiedzających, ich pochodzenia oraz stron odwiedzanych przez nich anoniowo.',
                                    }
                                ]
                            }
                        },
                        {
                            title: 'Więcej informacji',
                            description: 'Aby otrzymać więcej informacji na temat polityki prywatności lub zarządzania ciastkami na witrynie <a href="mailto:&#105;&#110;&#102;&#111;&#64;&#119;&#51;&#119;&#103;&#46;&#99;&#111;&#109;">skontaktuj się proszę ze mną.</a>'
                        }
                    ]
                }
            }
        }
    }
});