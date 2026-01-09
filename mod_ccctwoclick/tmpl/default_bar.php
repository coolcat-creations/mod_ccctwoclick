<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ccctwoclick
 *
 * Privacy bar block generation for the CCC Two Click template.
 *
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Build bar inline styles
$barStyles = [];

if ($barBackgroundColor !== '') {
    $barStyles[] = 'background:' . $escape($barBackgroundColor);
}
if ($barBorderRadius !== '') {
    $barStyles[] = 'border-radius:' . $escape($barBorderRadius);
}
if ($barTextColor !== '') {
    $barStyles[] = 'color:' . $escape($barTextColor);
}
if ($barBoxShadow !== '') {
    $barStyles[] = 'box-shadow:' . $escape($barBoxShadow);
}

$barStyleAttr = !empty($barStyles) ? ' style="' . implode(';', $barStyles) . '"' : '';

// Only create separate bar block when layout is NOT integrated
$barBlockHtml = '';
if (!$isIntegratedLayout && ($legalContentHtml !== '' || $detailsContentHtml !== '')) {
    ob_start();
    ?>

    <div class="ccctwoclick__block ccctwoclick__block--bar"
         data-ccctwoclick-block="bar"
         role="region"
         aria-label="<?php echo $escape($privacyBarAriaLabel); ?>"<?php echo $barStyleAttr; ?>>
        <?php if ($legalContentHtml !== '') : ?>
            <div class="ccctwoclick__bar-legal" data-ccctwoclick-legal>
                <?php echo $legalContentHtml; ?>
            </div>
        <?php endif; ?>
        <?php if ($detailsContentHtml !== '') : ?>
            <div class="ccctwoclick__bar-details" data-ccctwoclick-details-block>
                <?php echo $detailsContentHtml; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php
    $barBlockHtml = trim(ob_get_clean());
}

// Calculate bar slot positions
$barSlotPre = $barBlockHtml !== '' ? ($barPositionBefore === 'none' ? 'none' : 'pre-' . $barPositionBefore) : 'none';
if ($barSlotPre !== 'none' && !in_array($barSlotPre, ['pre-top', 'pre-overlay', 'pre-bottom'], true)) {
    $barSlotPre = 'pre-bottom';
}

$barSlotPost = $barBlockHtml !== '' ? ($barPositionAfter === 'none' ? 'none' : 'post-' . $barPositionAfter) : 'none';
if ($barSlotPost !== 'none' && !in_array($barSlotPost, ['post-top', 'post-bottom'], true)) {
    $barSlotPost = 'post-bottom';
}

// Renderer closures for placing blocks in slots
$cardRenderer = static function ($slotKey) use (&$cardBlockHtml, $cardSlotPre) {
    if ($cardBlockHtml !== '' && $cardSlotPre === $slotKey) {
        echo $cardBlockHtml;
        $cardBlockHtml = '';
    }
};

$barRenderer = static function ($slotKey) use (&$barBlockHtml, $barSlotPre) {
    if ($barBlockHtml !== '' && $barSlotPre === $slotKey) {
        echo $barBlockHtml;
        $barBlockHtml = '';
    }
};
