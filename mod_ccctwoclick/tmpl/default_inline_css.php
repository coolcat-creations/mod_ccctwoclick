<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ccctwoclick
 *
 * Inline CSS for the CCC Two Click template (used when stylesheet is disabled).
 *
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$inlineBaseCss = <<<'CSS'
.ccctwoclick__placeholder {
    position: relative;
    overflow: hidden;
    border-radius: 0;
}
.ccctwoclick__placeholder::before {
    content: '';
    position: absolute;
    inset: 0;
    background-color: var(--ccctwo-overlay-color, transparent);
    backdrop-filter: var(--ccctwo-overlay-blur, none);
    -webkit-backdrop-filter: var(--ccctwo-overlay-blur, none);
    opacity: var(--ccctwo-overlay-visible, 0);
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 1;
}
.ccctwoclick__placeholder > * {
    position: relative;
    z-index: 2;
}
.ccctwoclick__placeholder--responsive {
    aspect-ratio: var(--ccctwo-responsive-ratio, 16 / 9) !important;
    height: auto !important;
    min-height: 0 !important;
    max-height: none !important;
}
.ccctwoclick__placeholder--responsive .ccctwoclick__media {
    position: absolute !important;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
}
.ccctwoclick__placeholder--responsive .ccctwoclick__media iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    border: 0;
}
.ccctwoclick__overlay-slots {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 1.5rem;
    gap: 1rem;
    pointer-events: none;
    z-index: 3;
}
.ccctwoclick__overlay-slots > * {
    pointer-events: auto;
}
.ccctwoclick__overlay-slots .ccctwoclick__card-slot,
.ccctwoclick__overlay-slots .ccctwoclick__bar-slot {
    width: min(100%, 480px);
}
.ccctwoclick__overlay-slots .ccctwoclick__block {
    width: 100%;
}
.ccctwoclick__slot-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 0 0 1rem;
    width: 100%;
}
.ccctwoclick__slot-group--overlay {
    margin: 0;
}
.ccctwoclick__slot-group--post-top,
.ccctwoclick__slot-group--post-bottom {
    margin-top: 1rem;
}
.ccctwoclick__slot-group--post-bottom {
    margin-bottom: 0;
}
.ccctwoclick__slot-group .ccctwoclick__card-slot,
.ccctwoclick__slot-group .ccctwoclick__bar-slot {
    width: 100%;
}
.ccctwoclick__block {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 0.85rem;
    padding: 1.1rem 1.25rem;
    box-shadow: 0 14px 28px rgba(15, 23, 42, 0.16);
    width: 100%;
    box-sizing: border-box;
}
.ccctwoclick__block--bar {
    border-radius: 0.65rem;
    box-shadow: none;
    background: rgba(255, 255, 255, 0.7);
    padding: 0.85rem 1rem;
    font-size: 0.9rem;
}
.ccctwoclick__block--hidden {
    display: none !important;
}
.ccctwoclick__privacy-header {
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: 0.01em;
    margin-bottom: 0.65rem;
}
.ccctwoclick__copy {
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 0.75rem;
}
.ccctwoclick__controls {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.75rem;
    text-align: center;
}
.ccctwoclick__details-toggle {
    display: inline-flex;
    align-items: baseline;
    background: none;
    border: none;
    padding: 0;
    font-size: 0.9rem;
    color: inherit;
    cursor: pointer;
    text-decoration: underline;
}
CSS;

$inlineToggleCss = <<<'CSS'
.ccctwoclick-toggle {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}
.ccctwoclick-toggle__visual {
    position: relative;
    width: 40px;
    height: 22px;
    flex-shrink: 0;
}
.ccctwoclick-toggle__input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    margin: 0;
    cursor: pointer;
    z-index: 2;
    border: none;
    background: transparent;
}
.ccctwoclick-toggle__slider {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border-radius: 999px;
    background: #d7dfe6;
    border: 1px solid rgba(15, 23, 42, 0.12);
    transition: background 0.25s ease, box-shadow 0.25s ease;
}
.ccctwoclick-toggle__slider::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    border-radius: 999px;
    top: 2px;
    left: 3px;
    background: #fff;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.18);
    transition: transform 0.25s ease;
}
.ccctwoclick-toggle__input:focus-visible + .ccctwoclick-toggle__slider {
    box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.5);
}
.ccctwoclick-toggle__input:checked + .ccctwoclick-toggle__slider {
    background: #696969;
}
.ccctwoclick-toggle__input:checked + .ccctwoclick-toggle__slider::after {
    transform: translateX(18px);
}
CSS;
