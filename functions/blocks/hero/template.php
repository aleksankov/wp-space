<?php
    $color = get_field('color');
    $img = get_field('img');
    $title = get_field('title');
    $desc = get_field('desc');
    $btn_label = get_field('btn_label');
    $btn_url = get_field('btn_url');
    $link_label = get_field('link_label');
    $link_url = get_field('link_url');
    $po_img = get_field('po_img');
    $po_text = get_field('po_text');
    $po_url = get_field('po_url');
    $download_label = get_field('download_label');
    $download_items = get_field('download_items');
?>

<?php if( $color ): ?>
    <style>
        .product-hero .product-hero__title span{
            color: <?= $color; ?>;
        }
    </style>
<?php endif; ?>
<section class="product-hero product-hero--top<?= $download_label || $download_items ? ' product-hero--client' : ''; ?>" data-aos="fade-up">
    <div class="container">
        <div class="product-hero__wrap">
            <?php if( $img ): ?>
                <div class="product-hero__img">
                    <img src="<?= kama_thumb_src( 'wh=882:826', $img ); ?>" alt="<?php the_title(); ?>">
                </div>
            <?php endif; ?>
            <div class="product-hero__content">
                <?php if( $po_img || $po_text ): ?>
                    <div class="product-hero__register">
                        <?php if( $po_img ): ?>
                            <img src="<?= $po_img; ?>" alt="Минцифры">
                        <?php endif; ?>
                        <?php if( $po_text && $po_url ): ?>
                            <a href="<?= $po_url; ?>" target="_blank"><?= $po_text; ?></a>
                        <?php elseif( $po_text ): ?>
                            <span><?= $po_text; ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if( $title ): ?>
                    <h1 class="product-hero__title"><?= $title; ?></h1>
                <?php endif; ?>
                <?php if( $desc ): ?>
                    <div class="product-hero__desc"><?= $desc; ?></div>
                <?php endif; ?>
                <?php if( ($btn_label && $btn_url) || ($link_label && $link_url) ): ?>
                    <div class="product-hero__bottom">
                        <?php if( $btn_label && $btn_url ): ?>
                            <div class="product-hero__btn">
                                <?php if( $btn_url == '#download' ): ?>
                                    <a class="btn js-anchor" href="<?= $btn_url; ?>"><?= $btn_label; ?></a>
                                <?php elseif( isAnchorLink($btn_url) ): ?>
                                    <a class="btn" href="<?= $btn_url; ?>" data-fancybox="" data-touch="false"><?= $btn_label; ?></a>
                                <?php else: ?>
                                    <a class="btn" href="<?= $btn_url; ?>" target="_blank"><?= $btn_label; ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if( $link_label && $link_url ): ?>
                            <div class="product-hero__btn">
                                <?php if( isAnchorLink($link_url) ): ?>
                                    <a class="btn btn-transparent" href="<?= $link_url; ?>" data-fancybox="" data-touch="false"><?= $link_label; ?></a>
                                <?php else: ?>
                                    <a class="btn btn-transparent" href="<?= $link_url; ?>" target="_blank"><?= $link_label; ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if( $download_label || $download_items ): ?>
                    <div class="product-hero__app">
                        <?php if( $download_label ): ?>
                            <div class="product-hero__app-label"><?= $download_label; ?></div>
                        <?php endif; ?>
                        <?php if( $download_items ): ?>
                            <div class="product-hero__app-icons">
                                <?php $counter = 1; foreach( $download_items as $download_item ): ?>
                                    <?php if( $download_item['url'] ): ?>
                                        <a href="<?= $download_item['url']; ?>" target="_blank" class="product-hero__app-icon">
                                            <?php if( $download_item ): ?>
                                                <img src="<?= $download_item['img']; ?>" alt="Store Icon - <?= $counter; ?>">
                                            <?php endif; ?>
                                        </a>
                                    <?php else: ?>
                                        <div class="product-hero__app-icon">
                                            <?php if( $download_item ): ?>
                                                <img src="<?= $download_item['img']; ?>" alt="Store Icon - <?= $counter; ?>">
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php $counter++; endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
