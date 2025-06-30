<?php
// Extension configuration for Custom Blocks (ext_localconf.php)

// Register Custom Content Blocks YAML files for TYPO3 v13+
\FriendsOfTYPO3\ContentBlocks\ContentBlockRegistry::register(
    'EXT:custom_blocks/Configuration/ContentBlocks/Teaser.yaml'
);
\FriendsOfTYPO3\ContentBlocks\ContentBlockRegistry::register(
    'EXT:custom_blocks/Configuration/ContentBlocks/Accordion.yaml'
);
\FriendsOfTYPO3\ContentBlocks\ContentBlockRegistry::register(
    'EXT:custom_blocks/Configuration/ContentBlocks/Cta.yaml'
);
\FriendsOfTYPO3\ContentBlocks\ContentBlockRegistry::register(
    'EXT:custom_blocks/Configuration/ContentBlocks/Statsbox.yaml'
);
