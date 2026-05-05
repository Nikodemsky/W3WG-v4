/* (function () {
  const NAV_CLASS = 'preferences-navi';
  const HIDDEN_CLASS = 'preferences-navi--hidden';
  const MIN_WIDTH = 768;
  const MAX_WIDTH = 1024;

  let lastScrollY = window.scrollY;

  function getScrollPercent() {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
    return (scrollTop / (scrollHeight - clientHeight)) * 100;
  }

  function isInRange() {
    const w = window.innerWidth;
    return w >= MIN_WIDTH && w <= MAX_WIDTH;
  }

  function onScroll() {
    if (!isInRange()) return;

    const nav = document.querySelector(`.${NAV_CLASS}`);
    if (!nav) return;

    const scrollPercent = getScrollPercent();
    const scrollingDown = window.scrollY > lastScrollY;

    if (scrollPercent >= 50 && scrollingDown) {
      nav.classList.add(HIDDEN_CLASS);
    } else if (scrollPercent < 50 || !scrollingDown) {
      nav.classList.remove(HIDDEN_CLASS);
    }

    lastScrollY = window.scrollY;
  }

  window.addEventListener('scroll', onScroll, { passive: true });
})(); */

const toggle = document.querySelector('.pref-menu-toggle');
const nav = document.querySelector('.preferences-navi');
const navUls = nav.querySelectorAll('ul');

toggle.addEventListener('click', () => {
  const isHidden = nav.classList.toggle('preferences-navi--hidden');

  // Toggle aria-expanded on nav
  nav.setAttribute('aria-expanded', !isHidden);

  navUls.forEach(ul => {
    ul.setAttribute('tabindex', isHidden ? '-1' : '0');
    ul.setAttribute('aria-disabled', isHidden ? 'true' : 'false');
  });

  isHidden ? toggle.removeAttribute('tabindex') : toggle.setAttribute('tabindex', '-1');
});