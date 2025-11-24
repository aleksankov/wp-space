<?php
    get_header();

    $page_submenu = get_field('page_submenu');
?>
<section class="breadcrumbs-wrap">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')): ?>
            <div class="breadcrumbs-wrapper">
                <?php yoast_breadcrumb('<nav class="breadcrumbs">', '</nav>'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<div class="container">
    <?php if( $page_submenu ): ?>
        <nav class="header-submenu header-submenu-mobile js-svg-replace">
            <ul>
                <?php foreach( $page_submenu as $page_submenu_item ): ?>
                    <li class="<?= $page_submenu_item['type'] == 'dropdown' && $page_submenu_item['items'] ? ' js-submenu-toggle' : ''; ?>">
                        <?php if( $page_submenu_item['type'] == 'dropdown' && $page_submenu_item['items'] ): ?>
                            <span>
                            <?php if( $page_submenu_item['icon'] ): ?>
                                <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                            <?php endif; ?>
                            <span><?= $page_submenu_item['label']; ?></span>
                        </span>
                        <?php elseif( $page_submenu_item['type'] == 'url' && $page_submenu_item['url'] ): ?>
                            <a href="<?= $page_submenu_item['url']; ?>" target="_blank">
                                <?php if( $page_submenu_item['icon'] ): ?>
                                    <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                <?php endif; ?>
                                <span><?= $page_submenu_item['label']; ?></span>
                            </a>
                        <?php elseif( $page_submenu_item['type'] == 'anchor' && $page_submenu_item['url'] ): ?>
                            <a href="<?= $page_submenu_item['url']; ?>" class="js-anchor">
                                <?php if( $page_submenu_item['icon'] ): ?>
                                    <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                <?php endif; ?>
                                <span><?= $page_submenu_item['label']; ?></span>
                            </a>
                        <?php elseif( $page_submenu_item['type'] == 'file' && $page_submenu_item['file'] ): ?>
                            <a href="<?= $page_submenu_item['file']; ?>" target="_blank">
                                <?php if( $page_submenu_item['icon'] ): ?>
                                    <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                <?php endif; ?>
                                <span><?= $page_submenu_item['label']; ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if( $page_submenu_item['type'] == 'dropdown' && $page_submenu_item['items'] ): ?>
                            <div class="header-submenu__dropdown">
                                <div class="header-submenu__dropdown-list<?= $page_submenu_item['is_lg'] ? ' header-submenu__dropdown-list--lg' : ''; ?>">
                                    <?php foreach( $page_submenu_item['items'] as $page_submenu_li ): ?>
                                        <div class="header-submenu__dropdown-col">
                                            <?php if( $page_submenu_li['type'] == 'url' && $page_submenu_li['url'] ): ?>
                                            <a class="header-submenu__item" href="<?= $page_submenu_li['url']; ?>" target="_blank">
                                                <?php elseif( $page_submenu_li['type'] == 'anchor' && $page_submenu_li['url'] ): ?>
                                                <a class="header-submenu__item js-anchor" href="<?= $page_submenu_li['url']; ?>">
                                                    <?php elseif( $page_submenu_li['type'] == 'file' && $page_submenu_li['file'] ): ?>
                                                    <a class="header-submenu__item" href="<?= $page_submenu_li['file']; ?>" target="_blank">
                                                        <?php endif; ?>
                                                        <?php if( $page_submenu_li['icon'] ): ?>
                                                            <div class="header-submenu__item-img">
                                                                <img src="<?= $page_submenu_li['icon']; ?>" alt="<?= $page_submenu_li['label']; ?>">
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="header-submenu__item-content">
                                                            <?php if( $page_submenu_li['label'] ): ?>
                                                                <div class="header-submenu__item-sub"><?= $page_submenu_li['label']; ?></div>
                                                            <?php endif; ?>
                                                            <?php if( $page_submenu_li['desc'] ): ?>
                                                                <div class="header-submenu__item-desc"><?= $page_submenu_li['desc']; ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="header-submenu__item-icon">
                                                            <?php if( $page_submenu_li['type'] == 'file' ): ?>
                                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/header-submenu-download-icon.svg" alt="Download">
                                                            <?php else: ?>
                                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/header-submenu-link-icon.svg" alt="Link">
                                                            <?php endif; ?>
                                                        </div>
                                                    </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php
    the_content();
    get_footer();
?>
