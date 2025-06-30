<?php

// Registrierung des MASK-Teaser-Elements als neues CType
defined('TYPO3') or die();

// TCA-Konfiguration für das neue Inhaltselement
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'Teaser (MASK Demo)',
        'mask_teaser',
        'content-text',
    ]
);

// FlexForm für das Element einbinden
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'mask_teaser',
    'FILE:EXT:mask_elements/Configuration/FlexForms/Teaser.xml'
);
