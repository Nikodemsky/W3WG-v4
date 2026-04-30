## LANG: PL

# W3WG-v4
Czwarta wersja witryny w3wg.com

# Cel zmiany:
1. [x] Poprawa działania trybu wizualnego dark/light.
2. [x] Wdrożenie struktury nazw CSS z metodyki BEM.
3. [x] Wdrożenie modularnej struktury SCSS.
4. [x] Wdrożenie modularnej struktury szablonu motywu.
5. [x] Optymalizacja kodu CSS.
6. [x] Optymalizacja modułów, zarządzania i ładowania JS.
7. [x] Optymalizacja instalacji ogólna -> migracja z CMS WordPress na fork ClassicPress (powód: ogólna optymalizacja -> wycięcie w całości Gutenberga oraz przestarzałych modułów backendowych).
8. [ ] Optymalizacja zarządzania językami -> migracja ze wtyczki "Bogo" na "Sublanguage" (powód: Bogo jest zbyt ograniczony).
Update: Problemy konfiguracyjne wtyczki Sublanguage, potrzeba dalszej analizy
9. [x] Optymalizacja zarządzania ciastkami -> migracja ze wtyczki "Pressidium Cookie Consent" na "Cookies and Content Security Policy" (powód: zbyt rzadkie aktualizacje, obciążenie prostej funkcjonalności Reactem, brak kompatybilności z forkiem ClassicPress).
Update: Do zaktualizowania własny CSS, odpięcia natywnego arkusza + aktualizacja treści Polityki Prywatności.<br/>
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
23. [ ] Poprawa Accessibility (WCAG), włączając m.in.:

---

* [x] Dodanie opcji powiększenia fonta (dostepność/WCAG)
* [x] Poprawa kontrastów pomiędzy kolorami
* [x] Podamiana dynamicznych elementów typu accordion (kodowanych domyślnie poprzed elementy typu div) na semantyczne, typu &#60;details&#62; (w przyszłości, kiedy zostanie powszechnie wprowadzona obsługa interpolate-size dla przeglądarek innych, niż chromium, to wyłączenie również js z obsługi)
* [ ] Poprawa widoczności klikalnych linków
* [x] Poprawa widoczności elementów, które można przełączać klawiaturą (:focus)
* [x] Poprawa ułożenia elementów na powiększeniach do 200%
* [x] Wyłączenie animacji (włączając przejścia kolorów), jeśli użytkownik systemowo ustawił ograniczenie ruchu elementów

