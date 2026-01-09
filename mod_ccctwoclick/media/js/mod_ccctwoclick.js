(function (window, document) {
    'use strict';

    function bootstrap() {
        var containers = document.querySelectorAll('[data-ccctwoclick]');

        Array.prototype.forEach.call(containers, function (container) {
            var moduleId = container.getAttribute('data-ccctwoclick');
            if (!moduleId) {
                return;
            }

            var options = getOptions(moduleId, container);
            initializeInstance(container, options);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bootstrap);
    } else {
        bootstrap();
    }

    function getOptions(moduleId, container) {
        var options = {};

        if (window.Joomla && typeof window.Joomla.getOptions === 'function') {
            options = window.Joomla.getOptions('mod_ccctwoclick.' + moduleId, {}) || {};
        }

        if (!Object.prototype.hasOwnProperty.call(options, 'moduleId')) {
            options.moduleId = moduleId;
        }

        var delayAttr = container.getAttribute('data-load-delay');
        if (delayAttr !== null && delayAttr !== '') {
            var attrValue = parseInt(delayAttr, 10);

            if (!isNaN(attrValue)) {
                options.loadDelay = Math.max(0, attrValue);
            }
        }

        if (!Object.prototype.hasOwnProperty.call(options, 'loadDelay')) {
            options.loadDelay = 0;
        }

        if (!Object.prototype.hasOwnProperty.call(options, 'consentScope')) {
            options.consentScope = container.getAttribute('data-consent-scope') || 'domain';
        }

        if (!Object.prototype.hasOwnProperty.call(options, 'storeConsent')) {
            var storeAttr = container.getAttribute('data-store-consent');
            if (storeAttr !== null && storeAttr !== '') {
                options.storeConsent = storeAttr !== '0';
            }
        }

        if (!Object.prototype.hasOwnProperty.call(options, 'storeConsent')) {
            options.storeConsent = true;
        }

        if (!Object.prototype.hasOwnProperty.call(options, 'rememberAcrossSessions')) {
            options.rememberAcrossSessions = container.getAttribute('data-remember-consent') === '1';
        }

        return options;
    }

    function initializeInstance(container, options) {
        var placeholder = container.querySelector('[data-ccctwoclick-placeholder]');
        if (!placeholder) {
            return;
        }

        var disableButtonElement = container.querySelector('[data-ccctwoclick-disable]');
        var sourceValue = (placeholder.getAttribute('data-source') || '').trim();

        var normalizedOptions = normalizeOptions(options);

        var state = {
            moduleId: normalizedOptions.moduleId,
            options: normalizedOptions,
            container: container,
            placeholder: placeholder,
            dataset: placeholder.dataset || {},
            widthStyle: placeholder.getAttribute('data-width-style') || '',
            heightStyle: placeholder.getAttribute('data-height-style') || '',
            sourceUrl: sourceValue,
            mediaTarget: placeholder.querySelector('[data-ccctwoclick-media]') || placeholder,
            beforeBlock: container.querySelector('[data-ccctwoclick-before]'),
            afterBlock: container.querySelector('[data-ccctwoclick-after]'),
            toggleInput: container.querySelector('[data-ccctwoclick-toggle]'),
            toggleLabel: container.querySelector('[data-ccctwoclick-toggle-label]'),
            revealButton: container.querySelector('[data-ccctwoclick-reveal]'),
            disableButton: container.querySelector('[data-ccctwoclick-disable]'),
            detailToggle: container.querySelector('[data-ccctwoclick-details-toggle]'),
            detailBody: container.querySelector('[data-ccctwoclick-details]'),
            initialBackground: {
                image: placeholder.style.backgroundImage,
                size: placeholder.style.backgroundSize,
                color: placeholder.style.backgroundColor
            },
            storage: getStorage(normalizedOptions.rememberAcrossSessions, normalizedOptions.storeConsent),
            pendingEnable: null,
            consentKey: buildConsentKey(normalizedOptions.consentScope, sourceValue, normalizedOptions.moduleId),
            slots: {
                card: {
                    pre: container.getAttribute('data-card-slot-pre') || 'pre-overlay',
                    post: container.getAttribute('data-card-slot-post') || 'post-top'
                },
                bar: {
                    pre: container.getAttribute('data-bar-slot-pre') || 'none',
                    post: container.getAttribute('data-bar-slot-post') || 'none'
                }
            },
            blocks: {
                card: container.querySelector('[data-ccctwoclick-block=\"card\"]'),
                bar: container.querySelector('[data-ccctwoclick-block=\"bar\"]')
            }
        };

        prepareDetailsToggle(state);
        bindEvents(state);
        placeBlock(state, 'card', state.slots.card.pre);
        placeBlock(state, 'bar', state.slots.bar.pre);
        restoreConsent(state);
    }

    function normalizeOptions(options) {
        var normalized = Object.assign({
            loadDelay: 0,
            consentScope: 'domain',
            rememberAcrossSessions: false,
            storeConsent: true
        }, options || {});

        normalized.loadDelay = Math.max(0, parseInt(normalized.loadDelay, 10) || 0);
        normalized.storeConsent = !(
            normalized.storeConsent === false ||
            normalized.storeConsent === 0 ||
            normalized.storeConsent === '0'
        );

        if (['module', 'domain', 'global'].indexOf(normalized.consentScope) === -1) {
            normalized.consentScope = 'domain';
        }

        if (!normalized.storeConsent) {
            normalized.rememberAcrossSessions = false;
        } else {
            normalized.rememberAcrossSessions = !!normalized.rememberAcrossSessions;
        }

        return normalized;
    }

    function bindEvents(state) {
        if (state.revealButton) {
            state.revealButton.addEventListener('click', function (event) {
                event.preventDefault();
                enableContent(state, true);
            });
        }

        if (state.disableButton) {
            state.disableButton.addEventListener('click', function (event) {
                event.preventDefault();
                disableContent(state, true);
            });
        }

        if (state.toggleInput) {
            state.toggleInput.addEventListener('change', function (event) {
                if (event.target.checked) {
                    enableContent(state, true);
                } else {
                    disableContent(state, true);
                }
            });
        }
    }

    function prepareDetailsToggle(state) {
        if (!state.detailToggle || !state.detailBody) {
            return;
        }

        state.detailToggle.addEventListener('click', function () {
            var expanded = state.detailToggle.getAttribute('aria-expanded') === 'true';
            expanded = !expanded;
            state.detailToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            state.detailBody.hidden = !expanded;

            var label = expanded ? state.detailToggle.getAttribute('data-close-label') : state.detailToggle.getAttribute('data-open-label');
            if (label) {
                state.detailToggle.textContent = label;
            }
        });
    }

    function enableContent(state, triggeredByUser) {
        if (!state.placeholder || !state.sourceUrl) {
            return;
        }

        if (state.pendingEnable) {
            window.clearTimeout(state.pendingEnable);
            state.pendingEnable = null;
        }

        updateToggleLabel(state, true);

        if (triggeredByUser) {
            rememberConsent(state, true);
        }

        var finalizeActivation = function () {
            state.pendingEnable = null;
            applyEnabledState(state);
            renderIFrame(state, triggeredByUser);
        };

        var delay = triggeredByUser ? state.options.loadDelay : 0;
        if (delay > 0) {
            state.pendingEnable = window.setTimeout(finalizeActivation, delay);
        } else {
            finalizeActivation();
        }
    }

    function disableContent(state, clearConsent) {
        if (state.pendingEnable) {
            window.clearTimeout(state.pendingEnable);
            state.pendingEnable = null;
        }

        if (clearConsent) {
            rememberConsent(state, false);
        }

        updateToggleLabel(state, false);
        toggleBeforeAfter(state, false);
        toggleControls(state, false);
        state.container.classList.remove('ccctwoclick--has-consent');
        toggleOverlay(state, true);

        if (state.mediaTarget) {
            state.mediaTarget.innerHTML = '';
        }

        restorePlaceholderStyle(state);
        placeBlocks(state, false);

        if (clearConsent) {
            focusCardHeader(state);
        }
    }

    function renderIFrame(state, triggeredByUser) {
        if (!state.mediaTarget) {
            return;
        }

        var iframe = document.createElement('iframe');
        iframe.setAttribute('title', state.placeholder.getAttribute('data-iframetitle') || 'External content');
        iframe.setAttribute('scrolling', state.dataset.scrolling || 'no');
        iframe.setAttribute('frameborder', state.dataset.frameborder || '0');
        iframe.setAttribute('loading', 'lazy');

        if (state.dataset.allowfullscreen === '1') {
            iframe.setAttribute('allowfullscreen', 'true');
        }

        if (state.dataset.allowtransparency === '1') {
            iframe.setAttribute('allowtransparency', 'true');
        }

        if (state.dataset.iframename) {
            iframe.setAttribute('name', state.dataset.iframename);
        }

        if (state.dataset.responsive !== '1') {
            if (state.widthStyle) {
                iframe.style.width = state.widthStyle;
            } else if (state.dataset.width) {
                iframe.setAttribute('width', state.dataset.width);
            } else {
                iframe.style.width = '100%';
            }

            if (state.heightStyle) {
                iframe.style.height = state.heightStyle;
            } else if (state.dataset.height) {
                iframe.setAttribute('height', state.dataset.height);
                iframe.style.height = state.dataset.height + 'px';
            }
        }

        var shouldAutoplay = triggeredByUser && state.dataset.videoAutoplay === '1';
        iframe.src = buildAutoplayUrl(state.sourceUrl, shouldAutoplay);

        state.mediaTarget.innerHTML = '';
        state.mediaTarget.appendChild(iframe);
        state.placeholder.style.backgroundImage = 'none';
        state.placeholder.style.backgroundColor = 'transparent';

        if (state.disableButton) {
            state.disableButton.focus();
        }
    }

    function restorePlaceholderStyle(state) {
        if (!state.placeholder) {
            return;
        }

        state.placeholder.style.backgroundImage = state.initialBackground.image || '';
        state.placeholder.style.backgroundSize = state.initialBackground.size || '';
        state.placeholder.style.backgroundColor = state.initialBackground.color || '';
    }

    function applyEnabledState(state) {
        toggleBeforeAfter(state, true);
        toggleControls(state, true);
        placeBlocks(state, true);
        state.container.classList.add('ccctwoclick--has-consent');
        toggleOverlay(state, false);
    }

    function toggleBeforeAfter(state, enabled) {
        if (state.beforeBlock) {
            state.beforeBlock.hidden = !!enabled;
            state.beforeBlock.style.display = enabled ? 'none' : '';
        }
        if (state.afterBlock) {
            state.afterBlock.hidden = !enabled;
            state.afterBlock.style.display = enabled ? '' : 'none';
        }
    }

    function toggleControls(state, enabled) {
        if (state.revealButton) {
            state.revealButton.hidden = enabled;
        }
        if (state.disableButton) {
            state.disableButton.hidden = !enabled;
        }

        if (state.toggleInput) {
            state.toggleInput.checked = !!enabled;
        }
    }

    function toggleOverlay(state, show) {
        if (!state.placeholder || state.placeholder.dataset.overlay !== '1') {
            return;
        }

        state.placeholder.style.setProperty('--ccctwo-overlay-visible', show ? '1' : '0');
    }

    function updateToggleLabel(state, enabled) {
        if (!state.toggleInput || !state.toggleLabel) {
            return;
        }

        state.toggleInput.setAttribute('aria-checked', enabled ? 'true' : 'false');
        var label = enabled ? state.toggleInput.getAttribute('data-label-active') : state.toggleInput.getAttribute('data-label-inactive');
        if (label) {
            state.toggleLabel.textContent = label;
            state.toggleInput.setAttribute('aria-label', label);
        }
    }

    function focusCardHeader(state) {
        if (!state.container || !state.moduleId) {
            return;
        }

        var heading = state.container.querySelector('#ccctwoclick-heading-' + state.moduleId);
        if (heading && typeof heading.focus === 'function') {
            heading.focus();
        }
    }

    function placeBlocks(state, enabled) {
        placeBlock(state, 'card', enabled ? state.slots.card.post : state.slots.card.pre);
        placeBlock(state, 'bar', enabled ? state.slots.bar.post : state.slots.bar.pre);
    }

    function placeBlock(state, type, slotKey) {
        var node = type === 'card' ? state.blocks.card : state.blocks.bar;
        if (!node) {
            return;
        }

        if (!slotKey || slotKey === 'none') {
            node.classList.add('ccctwoclick__block--hidden');
            return;
        }

        var target = getSlot(state.container, type, slotKey);
        if (!target) {
            node.classList.add('ccctwoclick__block--hidden');
            return;
        }

        node.classList.remove('ccctwoclick__block--hidden');
        if (node.parentNode !== target) {
            target.appendChild(node);
        }
    }

    function getSlot(container, type, slotKey) {
        var selector = type === 'card'
            ? '[data-card-slot=\"' + slotKey + '\"]'
            : '[data-bar-slot=\"' + slotKey + '\"]';

        return container.querySelector(selector);
    }

    function rememberConsent(state, enabled) {
        if (!state.storage) {
            return;
        }

        try {
            if (enabled) {
                state.storage.setItem(state.consentKey, '1');
            } else {
                state.storage.removeItem(state.consentKey);
            }
        } catch (error) {
            // Storage might be blocked
        }
    }

    function restoreConsent(state) {
        try {
            if (state.storage && state.storage.getItem(state.consentKey) === '1') {
                enableContent(state, false);
                return;
            }
        } catch (error) {
            // ignore
        }

        disableContent(state, false);
    }

    function getStorage(persistent, storeConsent) {
        if (!storeConsent) {
            return null;
        }

        try {
            return persistent ? window.localStorage : window.sessionStorage;
        } catch (error) {
            return null;
        }
    }

    function buildConsentKey(scope, source, moduleId) {
        if (scope === 'global') {
            return 'ccctwoclick_global';
        }

        if (scope === 'module') {
            return 'ccctwoclick_module_' + moduleId;
        }

        try {
            var url = new URL(source, window.location.origin);
            var host = (url.hostname || '').replace(/^www\./i, '').toLowerCase();
            return 'ccctwoclick_domain_' + (host || 'generic');
        } catch (error) {
            return 'ccctwoclick_domain_generic';
        }
    }

    function buildAutoplayUrl(url, autoplay) {
        if (!autoplay) {
            return url;
        }

        var result = url;

        try {
            var parsed = new URL(url, window.location.href);
            var host = (parsed.hostname || '').replace(/^www\./i, '').toLowerCase();

            if (host.indexOf('youtube.com') !== -1 || host === 'youtu.be') {
                parsed.searchParams.set('autoplay', '1');
                parsed.searchParams.set('mute', '1');
                parsed.searchParams.set('playsinline', '1');
                result = parsed.toString();
            } else if (host.indexOf('vimeo.com') !== -1) {
                parsed.searchParams.set('autoplay', '1');
                parsed.searchParams.set('muted', '1');
                result = parsed.toString();
            } else {
                result = parsed.toString();
            }
        } catch (error) {
            if (url.indexOf('?') === -1) {
                result = url + '?autoplay=1';
            } else {
                result = url + '&autoplay=1';
            }
        }

        return result;
    }
})(window, document);
