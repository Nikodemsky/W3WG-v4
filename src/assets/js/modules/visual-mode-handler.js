(function () {
  const COOKIE_NAME = "vm-mode";
  const BODY_CLASS = "lightmode";

  const btnLight = document.querySelector(".vm-light");
  const btnDark  = document.querySelector(".vm-dark");
  const prismLight = document.getElementById("prism-css-light-css");
  const prismDark  = document.getElementById("prism-css-dark-css");

  function setCookie(value) {
    document.cookie = `${COOKIE_NAME}=${value}; path=/; max-age=${60 * 60 * 24 * 365}`;
  }

  function setPrismTheme(mode) {
    if (prismLight && prismDark) {
      if (mode === "light") {
        prismLight.removeAttribute("disabled");
        prismDark.setAttribute("disabled", "");
      } else {
        prismDark.removeAttribute("disabled");
        prismLight.setAttribute("disabled", "");
      }
    }
  }

  function setLightMode() {
    document.body.classList.add(BODY_CLASS);
    setCookie("light");
    btnLight.dataset.currentVisualMode = "1";
    btnDark.dataset.currentVisualMode  = "0";
    setPrismTheme("light");
  }

  function setDarkMode() {
    document.body.classList.remove(BODY_CLASS);
    setCookie("dark");
    btnLight.dataset.currentVisualMode = "0";
    btnDark.dataset.currentVisualMode  = "1";
    setPrismTheme("dark");
  }

  btnLight.addEventListener("click", setLightMode);
  btnDark.addEventListener("click", setDarkMode);

  // Restore saved preference on page load
  const saved = document.cookie
    .split("; ")
    .find(row => row.startsWith(COOKIE_NAME + "="))
    ?.split("=")[1];

  if (saved === "light") setLightMode();
})();