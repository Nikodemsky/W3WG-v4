import '../libs/cookieconsent.umd.js';

// Check for cookie - visual mode
function getCookie(name) {
  return document.cookie.split('; ').find(row => row.startsWith(name + '='))?.split('=')[1];
}

function setDarkMode(enabled) {
  document.documentElement.classList.toggle('cc--darkmode', enabled);
}

setDarkMode(getCookie('vm-mode') !== 'light');

document.querySelector('.vm-light button').onclick = () => setDarkMode(false);
document.querySelector('.vm-dark button').onclick = () => setDarkMode(true);

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

function logConsent() {
    const cookie = CookieConsent.getCookie();
    const preferences = CookieConsent.getUserPreferences();

    const userConsent = {
        consentId: cookie.consentId,
        acceptType: preferences.acceptType,
        acceptedCategories: preferences.acceptedCategories,
        rejectedCategories: preferences.rejectedCategories
    };

    fetch(wpConsent.apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': wpConsent.nonce   // <-- security token
        },
        body: JSON.stringify(userConsent)
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
        logConsent();
    },
    onConsent: () => {
        updateGtagConsent();
    },
    onChange: () => {
        updateGtagConsent();
        logConsent();
    },

    /* onFirstConsent: ({cookie}) => {
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
    } , */

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
            en: async () => {
                const res = await fetch(`${location.origin}/wp-content/themes/w3wg_v4/assets/lang/cookieconsent-en.json`);
                const str = JSON.stringify(await res.json())
                    .replaceAll('"CAT_NECESSARY"',    `"${CAT_NECESSARY}"`)
                    .replaceAll('"CAT_ANALYTICS"',    `"${CAT_ANALYTICS}"`)
                    .replaceAll('"location.hostname"', `"${location.hostname}"`);
                return JSON.parse(str);
            },
            pl: async () => {
                const res = await fetch(`${location.origin}/wp-content/themes/w3wg_v4/assets/lang/cookieconsent-pl.json`);
                const str = JSON.stringify(await res.json())
                    .replaceAll('"CAT_NECESSARY"',    `"${CAT_NECESSARY}"`)
                    .replaceAll('"CAT_ANALYTICS"',    `"${CAT_ANALYTICS}"`)
                    .replaceAll('"location.hostname"', `"${location.hostname}"`);
                return JSON.parse(str);
            }
        }
    }
});