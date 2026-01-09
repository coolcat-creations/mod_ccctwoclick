<?php

/**
 * @package     Joomla.Module
 * @subpackage  mod_ccctwoclick
 *
 * @copyright   Copyright (C) 2025 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\Helpers\Bootstrap;
use Joomla\CMS\Language\Text;

/**
 * Link picker field for selecting articles or menu items.
 *
 * @since  3.0.0
 */
class JFormFieldLinkpicker extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  3.0.0
	 */
	protected $type = 'Linkpicker';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   3.0.0
	 */
	protected function getInput(): string
	{
		$app       = Factory::getApplication();
		$document  = $app->getDocument();
		$inputId   = $this->id;
		$inputName = $this->name;
		$value     = htmlspecialchars((string) $this->value, ENT_COMPAT, 'UTF-8');

		$safeId         = preg_replace('/[^A-Za-z0-9_]/', '_', $inputId);
		$modalId        = $safeId . '_linkpickerModal';
		$articleFunc    = 'jSelectArticle_' . $safeId;
		$menuFunc       = 'jSelectMenu_' . $safeId;
		$articleSrc     = 'index.php?option=com_content&view=articles&layout=modal&tmpl=component&function=' . $articleFunc;
		$menuSrc        = 'index.php?option=com_menus&view=items&layout=modal&tmpl=component&client_id=0&function=' . $menuFunc;
		$articlePaneId  = $modalId . '_articles';
		$menuPaneId     = $modalId . '_menus';

		$input = '<div class="input-group ccc-two-linkpicker">'
			. '<input type="text" class="form-control" name="' . $inputName . '" id="' . $inputId . '" value="' . $value . '" />'
			. '<button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">'
			. Text::_('MOD_CCCTWOCLICK_LINK_PICKER_BUTTON') . '</button>'
			. '</div>';

		$tabs = '<div class="btn-group mb-3" role="group">'
			. '<button type="button" class="btn btn-outline-primary active" data-linkpicker-tab-target="#' . $articlePaneId . '">'
			. Text::_('MOD_CCCTWOCLICK_LINK_PICKER_TAB_ARTICLE') . '</button>'
			. '<button type="button" class="btn btn-outline-primary" data-linkpicker-tab-target="#' . $menuPaneId . '">'
			. Text::_('MOD_CCCTWOCLICK_LINK_PICKER_TAB_MENU') . '</button>'
			. '</div>';

		$body = $tabs
			. '<div id="' . $articlePaneId . '" class="linkpicker-pane">'
			. '<iframe src="' . $articleSrc . '" loading="lazy"></iframe>'
			. '</div>'
			. '<div id="' . $menuPaneId . '" class="linkpicker-pane d-none">'
			. '<iframe src="' . $menuSrc . '" loading="lazy"></iframe>'
			. '</div>';

		$modal = Bootstrap::renderModal(
			$modalId,
			[
				'title'  => Text::_('MOD_CCCTWOCLICK_LINK_PICKER_TITLE'),
				'footer' => false,
				'width'  => '900px',
			],
			$body
		);

		$script = <<<JS
(function() {
    const fieldId = '$inputId';
    const modalId = '$modalId';
    const articlePane = document.getElementById('$articlePaneId');
    const menuPane = document.getElementById('$menuPaneId');

    const setValue = function(value) {
        const input = document.getElementById(fieldId);
        if (input) {
            input.value = value;
            input.dispatchEvent(new Event('change'));
        }
    };

    function closeModal() {
        const modalEl = document.getElementById(modalId);
        if (modalEl && typeof bootstrap !== 'undefined') {
            const instance = bootstrap.Modal.getInstance(modalEl);
            if (instance) {
                instance.hide();
            }
        }
    }

    window['$articleFunc'] = function(id) {
        setValue('index.php?option=com_content&view=article&id=' + id);
        closeModal();
    };

    window['$menuFunc'] = function(id) {
        setValue('index.php?Itemid=' + id);
        closeModal();
    };

    document.addEventListener('DOMContentLoaded', function() {
        var modalEl = document.getElementById(modalId);
        if (!modalEl) {
            return;
        }
        modalEl.querySelectorAll('[data-linkpicker-tab-target]').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetSelector = button.getAttribute('data-linkpicker-tab-target');
                modalEl.querySelectorAll('.linkpicker-pane').forEach(function(pane) {
                    pane.classList.add('d-none');
                });
                modalEl.querySelectorAll('[data-linkpicker-tab-target]').forEach(function(btn) {
                    btn.classList.remove('active');
                });
                button.classList.add('active');
                const pane = modalEl.querySelector(targetSelector);
                if (pane) {
                    pane.classList.remove('d-none');
                }
            });
        });
    });
})();
JS;

		$document->addScriptDeclaration($script);
		$document->addStyleDeclaration('.linkpicker-pane{height:60vh;} .linkpicker-pane iframe{width:100%;height:100%;border:0;}');

		return $input . $modal;
	}
}
