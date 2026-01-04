<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ccctwoclick
 *
 * Helper functions for the CCC Two Click template.
 */
defined('_JEXEC') or die;

/**
 * Shortcut to escape any template output.
 *
 * @param   mixed  $value  Value to escape for output.
 *
 * @return  string
 */
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

/**
 * Normalises CSS size values so inline styles remain predictable.
 *
 * @param   string  $value  Raw width/height value from params.
 *
 * @return  string
 */
$normalizeCssSize = static function ($value) {
    $value = trim((string) $value);

    if ($value === '') {
        return '';
    }

    if (preg_match('#^(-?\d+(?:\.\d+)?)(?:\s*(px|%|rem|em|vh|vw|vmin|vmax))$#i', $value, $match)) {
        return $match[1] . strtolower($match[2]);
    }

    if (preg_match('#^calc\(.+\)$#i', $value)) {
        return $value;
    }

    if (preg_match('#^-?\d+(?:\.\d+)?$#', $value)) {
        return $value . 'px';
    }

    return $value;
};

/**
 * Extracts numeric parts from CSS values for data attributes.
 *
 * @param   string  $value  CSS measurement.
 *
 * @return  string
 */
$extractNumeric = static function ($value) {
    $value = trim((string) $value);

    if ($value === '') {
        return '';
    }

    if (preg_match('/^(\d+(?:\.\d+)?)$/', $value)) {
        return $value;
    }

    if (preg_match('/^(\d+(?:\.\d+)?)\s*px$/i', $value, $match)) {
        return $match[1];
    }

    return '';
};