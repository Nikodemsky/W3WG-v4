/*!
 * NanoBox v2.0.0 — Zero-dependency lightbox
 * MIT License
 */
(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory()
    : typeof define === 'function' && define.amd ? define(factory)
      : (global.NanoBox = factory());
}(typeof globalThis !== 'undefined' ? globalThis : this, function () {
  'use strict';

  const RE = {
    image: /\.(jpe?g|png|gif|webp|svg|avif)(\?.*)?$/i,
    youtube: /(?:youtube\.com\/(?:watch\?.*v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/,
    vimeo: /vimeo\.com\/(\d+)/,
    inline: /^#/,
  };
  const DEFAULTS = {
    animationDuration: 280, closeOnOverlayClick: true,
    escToClose: true, scrollLock: true, showSpinner: true,
    onOpen: null, onClose: null, onReady: null,
  };

  function ytEmbed(url) {
    const m = url.match(RE.youtube); if (!m) return null;
    const t = url.match(/[?&]t=(\w+)/);
    return 'https://www.youtube.com/embed/' + m[1] + '?rel=0' + (t ? '&start=' + t[1] : '');
  }
  function vmEmbed(url) {
    const m = url.match(RE.vimeo);
    return m ? 'https://player.vimeo.com/video/' + m[1] + '?dnt=1' : null;
  }
  function detect(src) {
    if (!src) return 'unknown';
    if (RE.inline.test(src)) return 'inline';
    if (RE.image.test(src)) return 'image';
    if (RE.youtube.test(src)) return 'youtube';
    if (RE.vimeo.test(src)) return 'vimeo';
    if (/^(https?:)?\/\//i.test(src)) return 'iframe';
    return 'unknown';
  }
  function mk(tag, cls) {
    const el = document.createElement(tag);
    if (cls) el.className = cls;
    return el;
  }

  class NanoBox {
    constructor(opts = {}) {
      this.opts = Object.assign({}, DEFAULTS, opts);
      this.isOpen = false;
      this.trigger = null;
      this.scrollY = 0;
      this._key = e => { if (e.key === 'Escape' && this.opts.escToClose) this.close(); };
      this._click = e => {
        const t = e.target.closest('[data-nanobox]');
        if (!t) return;
        const src = t.getAttribute('href') || t.getAttribute('data-src') || t.getAttribute('src');
        if (!src) return;
        if (t.tagName === 'A') e.preventDefault();
        this.trigger = t;
        this.open(src);
      };
      document.addEventListener('click', this._click);
    }

    open(src, overrides) {
      const opts = Object.assign({}, this.opts, overrides);
      if (this.isOpen) this._teardown(false);

      this.overlay = mk('div', 'nb-overlay');
      this.wrap = mk('div', 'nb-wrap');
      this.wrap.setAttribute('role', 'dialog');
      this.wrap.setAttribute('aria-modal', 'true');
      this.wrap.setAttribute('tabindex', '-1');
      this.box = mk('div', 'nb-box');
      this.spinner = mk('div', 'nb-spin');
      this.spinner.innerHTML = '<div class="nb-ring"></div>';
      this.spinner.setAttribute('aria-hidden', 'true');
      this.closeBtn = mk('button', 'nb-close');
      this.closeBtn.setAttribute('aria-label', 'Close');
      this.closeBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="1" y1="1" x2="13" y2="13"/><line x1="13" y1="1" x2="1" y2="13"/></svg>';
      this.closeBtn.addEventListener('click', () => this.close());
      this.box.append(this.closeBtn, this.spinner);
      this.wrap.appendChild(this.box);
      document.body.append(this.overlay, this.wrap);

      if (opts.closeOnOverlayClick)
        this.wrap.addEventListener('click', e => { if (e.target === this.wrap) this.close(); });

      if (opts.scrollLock) {
        document.documentElement.style.overflowY = 'hidden';
      }

      const type = detect(typeof src === 'string' ? src : '');
      switch (type) {
        case 'image': this._image(src, opts); break;
        case 'youtube': this._iframe(ytEmbed(src), opts); break;
        case 'vimeo': this._iframe(vmEmbed(src), opts); break;
        case 'iframe': this._iframe(src, opts); break;
        case 'inline': this._inline(src, opts); break;
        default: this.box.innerHTML += '<p class="nb-error">Cannot display this content.</p>';
      }

      requestAnimationFrame(() => requestAnimationFrame(() => {
        this.overlay.classList.add('nb-on');
        this.wrap.classList.add('nb-on');
      }));
      document.addEventListener('keydown', this._key);
      opts.onOpen && opts.onOpen(this);
      this.isOpen = true;
    }

    close() {
      if (!this.isOpen) return;
      this.overlay.classList.remove('nb-on');
      this.wrap.classList.remove('nb-on');
      setTimeout(() => {
        this._teardown(true);
        this.opts.onClose && this.opts.onClose(this);
      }, this.opts.animationDuration);
    }

    destroy() { this._teardown(false); document.removeEventListener('click', this._click); }

    _image(src, opts) {
      this.spinner.classList.add('on');

      const wrap = mk('div', 'nb-img-wrap');
      const img = document.createElement('img');
      img.className = 'nb-img';
      img.alt = '';
      img.draggable = false;

      img.onload = () => {
        this.spinner.classList.remove('on');
        this.wrap.focus();
        opts.onReady && opts.onReady(this, img);
      };

      img.onerror = () => {
        this.spinner.classList.remove('on');
        wrap.innerHTML = '<p class="nb-error">Image failed to load.</p>';
      };

      img.src = src;
      wrap.appendChild(img);
      this.box.appendChild(wrap);
    }

    _iframe(src, opts) {
      this.spinner.classList.add('on');
      const wrap = mk('div', 'nb-vid-wrap');
      const ratio = mk('div', 'nb-ratio');
      const iframe = document.createElement('iframe');
      iframe.src = src;
      iframe.setAttribute('allowfullscreen', '');
      iframe.setAttribute('allow', 'autoplay; fullscreen; picture-in-picture; encrypted-media');
      iframe.onload = () => {
        this.spinner.classList.remove('on');
        this.wrap.focus();
        opts.onReady && opts.onReady(this, iframe);
      };
      ratio.appendChild(iframe);
      wrap.appendChild(ratio);
      this.box.appendChild(wrap);
    }

    _inline(selector, opts) {
      const src = document.querySelector(selector);
      if (!src) {
        this.box.innerHTML += '<p class="nb-error">Element "' + selector + '" not found.</p>';
        return;
      }
      const wrap = mk('div', 'nb-inline-wrap');
      const clone = src.cloneNode(true);
      clone.style.display = ''; clone.removeAttribute('id');
      wrap.appendChild(clone);
      this.box.appendChild(wrap);
      this.wrap.focus();
      opts.onReady && opts.onReady(this, clone);
    }

    _teardown(restoreFocus) {
      document.removeEventListener('keydown', this._key);
      this.overlay && this.overlay.remove();
      this.wrap && this.wrap.remove();
      this.overlay = this.wrap = null;
      this.isOpen = false;
      document.documentElement.style.overflowY = '';
      if (restoreFocus && this.trigger) { this.trigger.focus(); this.trigger = null; }
    }
  }

  let _i = null;
  const api = {
    init(o = {}) { if (_i) _i.destroy(); _i = new NanoBox(o); return _i; },
    open(src, o) { if (!_i) _i = new NanoBox(); _i.open(src, o); },
    close() { _i && _i.close(); },
    destroy() { if (_i) { _i.destroy(); _i = null; } },
    create(o = {}) { return new NanoBox(o); },
    NanoBox,
  };

  // Auto-init: attach delegated listener as soon as the DOM is ready.
  // Calling NanoBox.init() manually is still supported and will re-init
  // with custom options, but it is no longer required for basic usage.
  if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => api.init());
    } else {
      api.init(); // DOM already ready (e.g. script at bottom of body)
    }
  }

  return api;
}));