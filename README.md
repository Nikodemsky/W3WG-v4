## LANG: PL

# W3WG-v4
Czwarta wersja witryny w3wg.com

# Cel zmiany:
1. Poprawa działania trybu wizualnego dark/light.
2. Wdrożenie struktury nazw CSS z metodyki BEM.
3. Wdrożenie modularnej struktury SCSS.
4. Wdrożenie modularnej struktury szablonu motywu.
5. Optymalizacja kodu CSS.
6. Optymalizacja modułów, zarządzania i ładowania JS.
7. Optymalizacja instalacji ogólna -> migracja z CMS WordPress na fork ClassicPress (powód: ogólna optymalizacja -> wycięcie w całości Gutenberga oraz przestarzałych modułów backendowych).
8. Optymalizacja zarządzania językami -> migracja ze wtyczki "Bogo" na "Sublanguage" (powód: Bogo jest zbyt ograniczony).
9. Optymalizacja zarządzania ciastkami -> migracja ze wtyczki "Pressidium Cookie Consent" na "Cookies and Content Security Policy" (powód: zbyt rzadkie aktualizacje, obciążenie prostej funkcjonalności Reactem, brak kompatybilności z forkiem ClassicPress).
10. Optymalizacja wewnętrznej taksonomii blogowej (powód: obecnie dla niestandardowych wpisów jest używana oddzielna wtyczka, umożliwiająca wybór unikalnego szablonu dla wpisu blogowego - jest to niepotrzebne i można zastosować natywną, nieindeksowalną taksonomię i na jej podstawie zaimplementować unikalne szablony dla poszczególnych wpisów).
11. Delikatne poprawki wizualne, jak np. zmiany ikon social media.
12. Optymalizacja i aktualizacja skryptu podświetlania kodu (PrismJS).
13. Poprawa semantyczności nawigacji personalizacji/języka.
14. Lokalne ładowanie fontów zamiast CDN.
15. Poprawa sanityzacji linków w kodzie.
16. Poprawa usadowienia elementów do pozycji relatywnych, z wyłączeniem zastosowań position:absolute, gdzie to możliwe.
17. Oczyszczenie kodu istniejących wpisów blogowych.
18. Poprawa czytelności istniejących wpisów blogowych (interlinie, listy itd.).
19. Poprawa FCP/LCP.
20. Przeredagowanie istniejących wpisów blogowych.
21. Dodanie danych schema dla typów "article" i "LocalBusiness".
22. Podmiana wtyczki FCP Lightest Lightbox na skrypt NanoBox (62kb->8kb)
23. Poprawa Accessibility (WCAG), włączając m.in.:
* Dodanie opcji powiększenia fonta (dostepność/WCAG)
* Poprawa kontrastów pomiędzy kolorami
* Podamiana dynamicznych elementów typu accordion (kodowanych domyślnie poprzed elementy typu div) na semantyczne, typu &#60;details&#62; (w przyszłości, kiedy zostanie powszechnie wprowadzona obsługa interpolate-size dla przeglądarek innych, niż chromium, to wyłączenie również js z obsługi)
* Poprawa widoczności klikalnych linków
* Poprawa widoczności elementów, które można przełączać klawiaturą (:focus)
* Poprawa ułożenia elementów na powiększeniach do 200%
* Wyłączenie animacji (włączając przejścia kolorów), jeśli użytkownik systemowo ustawił ograniczenie ruchu elementów

