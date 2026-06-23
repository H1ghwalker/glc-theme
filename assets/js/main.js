document.addEventListener('DOMContentLoaded', function () {

    // ── Бургер меню ──
    const burger  = document.querySelector('.header__burger');
    const navRow  = document.querySelector('.header__row--nav');
    const mobileQuery = window.matchMedia('(max-width: 1024px)');

    function closeMobileMenu() {
        navRow?.classList.remove('is-open');
        burger?.classList.remove('is-active');
        burger?.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('has-mobile-menu-open');
    }

    function resetMobileMega() {
        if (!mobileQuery.matches) return;

        document.querySelectorAll('.mega-menu__cat-item').forEach(function (item) {
            item.classList.remove('is-active');
        });
    }

    if (burger && navRow) {
        burger.setAttribute('aria-expanded', 'false');

        burger.addEventListener('click', function () {
            const isOpen = navRow.classList.toggle('is-open');
            burger.classList.toggle('is-active', isOpen);
            burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            document.body.classList.toggle('has-mobile-menu-open', isOpen);

            const mobileMegaParent = document.querySelector('.header__menu > li.has-mega');
            if (mobileMegaParent && mobileQuery.matches) {
                mobileMegaParent.classList.toggle('is-open', isOpen);
                if (isOpen) resetMobileMega();
            }
        });
    }

    // ── Мега-меню "Послуги": відкриття/закриття по кліку ──
    const megaParent = document.querySelector('.header__menu > li.has-mega');
    const megaToggle = megaParent && megaParent.querySelector('.mega-menu__toggle');

    if (megaParent && megaToggle) {
        megaToggle.addEventListener('click', function (e) {
            e.preventDefault();
            megaParent.classList.toggle('is-open');
        });

        document.addEventListener('click', function (e) {
            if (mobileQuery.matches) return;

            if (!megaParent.contains(e.target)) {
                megaParent.classList.remove('is-open');
            }
        });
    }

    // ── Мега-меню "Послуги": перемикання категорій ──
    document.querySelectorAll('.mega-menu__cat-item').forEach(function (catItem) {
        catItem.addEventListener('mouseenter', function () {
            const megaMenu = catItem.closest('.mega-menu');
            if (!megaMenu) return;

            megaMenu.querySelectorAll('.mega-menu__cat-item').forEach(i => i.classList.remove('is-active'));
            catItem.classList.add('is-active');

            const title = megaMenu.querySelector('.mega-menu__active-title');
            const detailBtn = megaMenu.querySelector('.mega-menu__detail-btn');
            if (title) title.textContent = catItem.dataset.title;
            if (detailBtn) detailBtn.href = catItem.dataset.link;
        });
    });

    document.querySelectorAll('.mega-menu__cat-item.has-children > a').forEach(function (catLink) {
        catLink.addEventListener('click', function (e) {
            if (!mobileQuery.matches) return;

            e.preventDefault();

            const catItem = catLink.closest('.mega-menu__cat-item');
            const megaMenu = catLink.closest('.mega-menu');
            if (!catItem || !megaMenu) return;

            const isActive = catItem.classList.contains('is-active');
            megaMenu.querySelectorAll('.mega-menu__cat-item').forEach(function (item) {
                item.classList.remove('is-active');
            });

            if (!isActive) {
                catItem.classList.add('is-active');
            }
        });
    });

    mobileQuery.addEventListener('change', function () {
        closeMobileMenu();
        megaParent?.classList.remove('is-open');
        resetMobileMega();
    });

    // ── Helpers ──
    function syncNavVisibility(swiper, prev, next) {
        const hide = swiper.isBeginning && swiper.isEnd;
        [prev, next].forEach(el => { if (el) el.style.display = hide ? 'none' : ''; });
    }

    function hoverSwap(selector) {
        document.querySelectorAll(selector + ' img[data-active]').forEach(img => {
            const normal = img.getAttribute('src');
            const active = img.getAttribute('data-active');
            img.closest('button').addEventListener('mouseenter', () => img.src = active);
            img.closest('button').addEventListener('mouseleave', () => img.src = normal);
        });
    }

    // Popup forms
    let activeModal = null;
    let lastFocusedBeforeModal = null;

    function getPopupId(value) {
        if (!value) return '';

        const raw = value.trim();
        if (!raw) return '';

        if (raw.charAt(0) === '#') {
            return raw.slice(1);
        }

        try {
            const url = new URL(raw, window.location.href);
            return url.origin === window.location.origin && url.pathname === window.location.pathname
                ? url.hash.slice(1)
                : '';
        } catch (e) {
            return raw;
        }
    }

    function openModal(modal) {
        if (!modal) return;

        if (activeModal) closeModal(activeModal);

        lastFocusedBeforeModal = document.activeElement;
        activeModal = modal;

        modal.hidden = false;
        modal.classList.remove('is-closing');
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('has-glc-modal-open');

        const focusTarget = modal.querySelector('.glc-modal__close, button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusTarget) focusTarget.focus({ preventScroll: true });
    }

    function closeModal(modal) {
        if (!modal) return;

        modal.classList.remove('is-open');
        modal.classList.add('is-closing');
        modal.setAttribute('aria-hidden', 'true');

        window.setTimeout(function () {
            modal.hidden = true;
            modal.classList.remove('is-closing');
            document.body.classList.remove('has-glc-modal-open');

            if (lastFocusedBeforeModal && typeof lastFocusedBeforeModal.focus === 'function') {
                lastFocusedBeforeModal.focus({ preventScroll: true });
            }
        }, 180);

        if (activeModal === modal) activeModal = null;
    }

    document.addEventListener('click', function (e) {
        const popupTrigger = e.target.closest('[data-popup], a[href^="#"]');
        if (!popupTrigger) return;

        const popupId = getPopupId(popupTrigger.dataset.popup || popupTrigger.getAttribute('href'));
        if (!popupId) return;

        const modal = document.getElementById(popupId);
        if (!modal || !modal.classList.contains('glc-modal')) return;

        e.preventDefault();
        openModal(modal);
    });

    document.addEventListener('click', function (e) {
        const closeBtn = e.target.closest('[data-popup-close]');
        if (!closeBtn) return;

        const modal = closeBtn.closest('.glc-modal');
        if (modal) closeModal(modal);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && activeModal) {
            closeModal(activeModal);
        }
    });

    // ── Photo Report слайдер ──
    if (document.querySelector('.photo-report__swiper')) {
        hoverSwap('.photo-report__nav');
        const prPrev = document.querySelector('.photo-report__nav--prev');
        const prNext = document.querySelector('.photo-report__nav--next');

        new Swiper('.photo-report__swiper', {
            slidesPerView: 3,
            spaceBetween: 16,
            navigation: {
                prevEl: '.photo-report__nav--prev',
                nextEl: '.photo-report__nav--next',
            },
            pagination: {
                el: '.photo-report__pagination',
                clickable: true,
            },
            breakpoints: {
                0:   { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                1024:{ slidesPerView: 3 },
            },
            on: {
                init(sw)       { syncNavVisibility(sw, prPrev, prNext); },
                breakpoint(sw) { syncNavVisibility(sw, prPrev, prNext); },
                slideChange(sw){ syncNavVisibility(sw, prPrev, prNext); },
            },
        });
    }

    // ── Vehicles слайдер ──
    if (document.querySelector('.vehicles__swiper')) {
        hoverSwap('.vehicles__nav');
        const vPrev = document.querySelector('.vehicles__nav--prev');
        const vNext = document.querySelector('.vehicles__nav--next');

        new Swiper('.vehicles__swiper', {
            slidesPerView: 3,
            spaceBetween: 24,
            navigation: {
                prevEl: '.vehicles__nav--prev',
                nextEl: '.vehicles__nav--next',
            },
            pagination: {
                el: '.vehicles__pagination',
                clickable: true,
            },
            breakpoints: {
                0:   { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                1024:{ slidesPerView: 3 },
            },
            on: {
                init(sw)       { syncNavVisibility(sw, vPrev, vNext); },
                breakpoint(sw) { syncNavVisibility(sw, vPrev, vNext); },
                slideChange(sw){ syncNavVisibility(sw, vPrev, vNext); },
            },
        });
    }

    // ── Reviews: слайдер + розгортання тексту ──
    if (document.querySelector('.reviews__swiper')) {
        hoverSwap('.reviews__nav');
        const rPrev = document.querySelector('.reviews__nav--prev');
        const rNext = document.querySelector('.reviews__nav--next');

        new Swiper('.reviews__swiper', {
            slidesPerView: 3,
            spaceBetween: 24,
            navigation: {
                prevEl: '.reviews__nav--prev',
                nextEl: '.reviews__nav--next',
            },
            pagination: {
                el: '.reviews__pagination',
                clickable: true,
            },
            breakpoints: {
                0:    { slidesPerView: 1 },
                640:  { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
            on: {
                init(sw)       { syncNavVisibility(sw, rPrev, rNext); },
                breakpoint(sw) { syncNavVisibility(sw, rPrev, rNext); },
                slideChange(sw){ syncNavVisibility(sw, rPrev, rNext); },
            },
        });

        // Показуємо toggle тільки якщо текст обрізається
        document.querySelectorAll('.review-card').forEach(card => {
            const text   = card.querySelector('.review-card__text');
            const toggle = card.querySelector('.review-card__toggle');
            if (!text || !toggle) return;
            if (text.scrollHeight > text.clientHeight + 2) {
                toggle.classList.add('is-visible');
            }
        });

        // Розгортання/згортання
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.review-card__toggle');
            if (!btn) return;
            const card = btn.closest('.review-card');
            const text = card.querySelector('.review-card__text');
            text.classList.toggle('is-expanded');
            btn.classList.toggle('is-open');
        });
    }

    // ── Services Hero: один Swiper для зображень ──
    if (document.querySelector('.services-hero__swiper')) {
        hoverSwap('.services-hero__nav');
        const shPrev  = document.querySelector('.services-hero__nav--prev');
        const shNext  = document.querySelector('.services-hero__nav--next');
        const shCount = document.querySelectorAll('.services-hero__swiper .swiper-slide').length;

        if (shCount <= 1) {
            if (shPrev) shPrev.style.display = 'none';
            if (shNext) shNext.style.display = 'none';
        }

        const servicesSwiper = new Swiper('.services-hero__swiper', {
            loop: shCount > 1,
            speed: 500,
            autoplay: shCount > 1 ? { delay: 4000, disableOnInteraction: false } : false,
            pagination: {
                el: '.services-hero__pagination',
                clickable: true,
            },
        });

        shPrev?.addEventListener('click', () => servicesSwiper.slidePrev());
        shNext?.addEventListener('click', () => servicesSwiper.slideNext());
    }

    // ── Hero: один Swiper ──
    if (document.querySelector('.hero__swiper')) {
        hoverSwap('.hero__nav');
        const hPrev  = document.querySelector('.hero__nav--prev');
        const hNext  = document.querySelector('.hero__nav--next');
        const hCount = document.querySelectorAll('.hero__swiper .swiper-slide').length;

        if (hCount <= 1) {
            if (hPrev) hPrev.style.display = 'none';
            if (hNext) hNext.style.display = 'none';
        }

        const heroSwiper = new Swiper('.hero__swiper', {
            loop: hCount > 1,
            speed: 500,
            autoplay: hCount > 1 ? { delay: 5000, disableOnInteraction: false } : false,
            pagination: {
                el: '.hero__pagination',
                clickable: true,
            },
        });

        hPrev?.addEventListener('click', () => heroSwiper.slidePrev());
        hNext?.addEventListener('click', () => heroSwiper.slideNext());
    }

    // ── Scroll to top ──
    const scrollTopBtn = document.getElementById('scrollTopBtn');
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ── Services: sidebar tabs ──
    document.querySelectorAll('.svc-sidebar__item').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.getAttribute('data-tab');
            const section = this.closest('.svc-section');
            if (!section) return;

            section.querySelectorAll('.svc-sidebar__item').forEach(b => b.classList.remove('is-active'));
            section.querySelectorAll('.svc-panel').forEach(p => p.classList.remove('is-active'));

            this.classList.add('is-active');
            const panel = section.querySelector(`.svc-panel[data-panel="${target}"]`);
            if (panel) panel.classList.add('is-active');
        });
    });

    // ── Services: accordion ──
    document.querySelectorAll('.svc-accordion__head').forEach(head => {
        head.addEventListener('click', function () {
            const item = this.closest('.svc-accordion__item');
            const accordion = item.closest('.svc-accordion');

            accordion.querySelectorAll('.svc-accordion__item').forEach(i => i.classList.remove('is-open'));
            item.classList.add('is-open');
        });
    });

    // SEO text toggle
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.seo-text__toggle');
        if (!btn) return;

        const preview = document.getElementById(btn.dataset.preview);
        const full    = document.getElementById(btn.dataset.full);
        const isOpen  = full.style.display !== 'none';

        preview.style.display = isOpen ? 'block' : 'none';
        full.style.display    = isOpen ? 'none'  : 'block';
        btn.textContent       = isOpen ? 'Читати далі' : 'Згорнути';
    });

    // ── Аналітика: конверсії ──
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href^="tel:"]');
        if (!link) return;

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'click_phone',
            phone_number: link.getAttribute('href').replace('tel:', ''),
        });
    });

    document.addEventListener('fluentform_submission_success', function (e) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'generate_lead',
            form_id: e.detail?.config?.id || '',
        });
    });

});
