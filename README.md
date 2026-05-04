## LANG: EN

# W3WG-v4
Fourth version of w3wg.com website

# Purpose of upgrade/change:
1. [x] Improve handling of visual modes (dark/light).
2. [x] Introduction of BEM CSS naming structure.
3. [x] Introduction of modular structure of SCSS.
4. [x] Introduction of modular structure of theme.
5. [x] CSS code optimizations.
6. [x] Optimizations of handling, management and priorities of internal javascript.
7. [x] General optimization of CSM installation, migration to ClassicPress fork.
8. [x] Migration from Bogo multilanguage plugin to native handling of languages (no plugins involved).
8. [x] Language management optimization -> migration from "Bogo" to "Sublanguage" (reason: Bogo is too limited).<br/>
~~Update 1: Sublanguage plugin configuration issues, further analysis needed~~<br/>
Update 2: Switching to a native translation system, without external plugins.
9. [x] Cookie management optimization -> migration from the "Pressidium Cookie Consent" to "Cookies and Content Security Policy" (reason: too infrequent updates, simple functionality burdened by React, incompatibility with the ClassicPress fork).<br/>
~~Update 1: Custom CSS to be updated, native stylesheet unlinked + Privacy Policy content updated.~~<br/>
Update 2: Changed to CookieConsent (https://github.com/orestbida/cookieconsent/) with its own configuration and logging, without the use of plugins.<br/>
10. [x] Optimization of internal blog taxonomy (reason: currently a separate plugin is used for custom post templates - this is unnecessary and you can use a native, non-indexable taxonomy and implement unique templates for individual posts based on it).
11. [x] Subtle visual tweaks, such as changes to social media icons.
12. [x] Optimization and update of code highlighting script (PrismJS).
13. [x] Improved semantics and accessibility of personalization/language navigation.
14. [x] Load fonts locally instead of via CDN.
16. [x] Improved element positioning to relative positions, excluding "position:absolute" uses whenever possible.
17. [x] Code cleanup of existing blog posts.
18. [x] Improving the readability of existing blog entries (line-height, lists, etc.).
19. [x] Improvement of FCP/LCP scores.
20. [x] Rewriting of existing blog entries.
21. [x] Added schema data for "article" and "LocalBusiness" types.
22. [x] Replacing the FCP Lightest Lightbox plugin with the NanoBox script (62kb->8kb)
23. [x] Improving Accessibility (WCAG), including:

---

* [x] Added option to enlarge fonts
* [x] Improving contrasts between colors
* [x] Replacing dynamic accordion elements with semantic &#60;details&#62; elements (in the future, when interpolate-size support for non-chromium browsers is widely implemented, this will also exclude js from handling animations)
* [x] Improving the visibility of clickable links
* [x] Improved visibility of keyboard-toggleable elements (:focus)
* [x] Improved element alignment on enlargements up to 200%
* [x] Disabling animations (including color transitions) if the user has limited movement option set in system

---

## LANG: PL

# W3WG-v4
Czwarta wersja witryny w3wg.com

# Cel zmiany:
1. [x] Poprawa działania trybu wizualnego ciemny/jasny.
2. [x] Wdrożenie struktury nazw CSS z metodyki BEM.
3. [x] Wdrożenie modularnej struktury SCSS.
4. [x] Wdrożenie modularnej struktury szablonu motywu.
5. [x] Optymalizacja kodu CSS.
6. [x] Optymalizacja modułów, zarządzania i ładowania JS.
7. [x] Optymalizacja instalacji ogólna -> migracja z CMS WordPress na fork ClassicPress (powód: ogólna optymalizacja -> wycięcie w całości Gutenberga oraz przestarzałych modułów backendowych).
8. [x] Optymalizacja zarządzania językami -> migracja ze wtyczki "Bogo" na "Sublanguage" (powód: Bogo jest zbyt ograniczony).<br/>
~~Update 1: Problemy konfiguracyjne wtyczki Sublanguage, potrzeba dalszej analizy~~<br/>
Update 2: Przejście na natywny system tłumaczeń, bez udziału wtyczek.
9. [x] Optymalizacja zarządzania ciastkami -> migracja ze wtyczki "Pressidium Cookie Consent" na "Cookies and Content Security Policy" (powód: zbyt rzadkie aktualizacje, obciążenie prostej funkcjonalności Reactem, brak kompatybilności z forkiem ClassicPress).<br/>
~~Update 1: Do zaktualizowania własny CSS, odpięcia natywnego arkusza + aktualizacja treści Polityki Prywatności.~~<br/>
Update 2: Zmiana na CookieConsent (https://github.com/orestbida/cookieconsent/) z własną konfiguracją i zapisem logów, bez udziału wtyczek.<br/>
10. [x] Optymalizacja wewnętrznej taksonomii blogowej (powód: obecnie dla niestandardowych wpisów jest używana oddzielna wtyczka, umożliwiająca wybór unikalnego szablonu dla wpisu blogowego - jest to niepotrzebne i można zastosować natywną, nieindeksowalną taksonomię i na jej podstawie zaimplementować unikalne szablony dla poszczególnych wpisów).
11. [x] Delikatne poprawki wizualne, jak np. zmiany ikon social media.
12. [x] Optymalizacja i aktualizacja skryptu podświetlania kodu (PrismJS).
13. [x] Poprawa semantyczności nawigacji personalizacji/języka.
14. [x] Lokalne ładowanie fontów zamiast CDN.
15. [x] Poprawa sanityzacji linków w kodzie.
16. [x] Poprawa usadowienia elementów do pozycji relatywnych, z wyłączeniem zastosowań position:absolute, gdzie to możliwe.
17. [x] Oczyszczenie kodu istniejących wpisów blogowych.
18. [x] Poprawa czytelności istniejących wpisów blogowych (interlinie, listy itd.).
19. [x] Poprawa FCP/LCP.
20. [x] Przeredagowanie istniejących wpisów blogowych.
21. [x] Dodanie danych schema dla typów "article" i "LocalBusiness".
22. [x] Podmiana wtyczki FCP Lightest Lightbox na skrypt NanoBox (62kb->8kb)
23. [x] Poprawa Accessibility (WCAG), włączając m.in.:

---

* [x] Dodanie opcji powiększenia fonta (dostepność/WCAG)
* [x] Poprawa kontrastów pomiędzy kolorami
* [x] Podamiana dynamicznych elementów typu accordion (kodowanych domyślnie poprzed elementy typu div) na semantyczne, typu &#60;details&#62; (w przyszłości, kiedy zostanie powszechnie wprowadzona obsługa interpolate-size dla przeglądarek innych, niż chromium, to wyłączenie również js z obsługi)
* [x] Poprawa widoczności klikalnych linków
* [x] Poprawa widoczności elementów, które można przełączać klawiaturą (:focus)
* [x] Poprawa ułożenia elementów na powiększeniach do 200%
* [x] Wyłączenie animacji (włączając przejścia kolorów), jeśli użytkownik systemowo ustawił ograniczenie ruchu elementów