<?php
// Extension configuration for Content Blocks (ext_localconf.php)

// Register Content Blocks YAML files for TYPO3 v13+
\TYPO3\CMS\Core\ContentBlocks\ContentBlockRegistry::register(
    'EXT:content_blocks/Configuration/ContentBlocks/Teaser.yaml'
);
\TYPO3\CMS\Core\ContentBlocks\ContentBlockRegistry::register(
    'EXT:content_blocks/Configuration/ContentBlocks/Accordion.yaml'
);
\TYPO3\CMS\Core\ContentBlocks\ContentBlockRegistry::register(
    'EXT:content_blocks/Configuration/ContentBlocks/Cta.yaml'
);
\TYPO3\CMS\Core\ContentBlocks\ContentBlockRegistry::register(
    'EXT:content_blocks/Configuration/ContentBlocks/Statsbox.yaml'
);
