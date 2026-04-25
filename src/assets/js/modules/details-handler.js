function setDetailsMaxHeight(details) {
  const wasOpen = details.open;

  // Temporarily open to get accurate measurements
  details.removeAttribute('open');
  details.setAttribute('open', '');

  const contentHeight = [...details.children]
    .filter(el => el.tagName !== 'SUMMARY')
    .reduce((sum, el) => sum + el.offsetHeight, 100);

  const rootFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize);
  const contentHeightRem = contentHeight / rootFontSize;

  details.style.setProperty('--details-max-height', `${contentHeightRem}rem`);

  // Restore original state without triggering transition
  details.toggleAttribute('open', wasOpen);
}

const allDetails = document.querySelectorAll('details');
allDetails.forEach(setDetailsMaxHeight);

// Recalculate on resize (debounced)
let resizeTimer;
window.addEventListener('resize', () => {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(() => allDetails.forEach(setDetailsMaxHeight), 150);

document.querySelector('#site-font-resize')
  ?.addEventListener('click', () => {
    // Wait a frame for the font/layout change to apply
    requestAnimationFrame(() => allDetails.forEach(setDetailsMaxHeight));
  });

});