<?php
    $color = get_field('color');
    $sections = get_field('sections');
?>

<?php if( $color ): ?>
    <style>
        .product-tech .product-tech__title span{
            color: <?= $color; ?>;
        }
    </style>
<?php endif; ?>

<?php if( $sections ): ?>
    <section class="product-tech section">
        <div class="container">
            <div class="product-tech__tags" data-aos="fade-up">
                <div class="main-tags main-tags--violet">
                    <div class="main-tags__row">
                        <?php $counter = 1; foreach( $sections as $section ): if( $section['label'] ):?>
                            <button class="main-tags__item js-product-tech-tag<?= $counter == 1 ? ' active' : ''; ?>" type="button"><?= $section['label']; ?></button>
                        <?php $counter++; endif; endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="product-tech__variations">
                <?php $img_counter = 1; $counter = 1; foreach( $sections as $section ): ?>
                    <div class="product-tech__variation js-product-tech-variation"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                        <div class="product-tech__wrap row-lg">
                            <div class="product-tech__left col-lg" data-aos="fade-up">
                                <?php if( $section['title'] ): ?>
                                    <h2 class="product-tech__title"><?= $section['title']; ?></h2>
                                <?php endif; ?>
                                <?php if( $section['desc'] ): ?>
                                    <div class="product-tech__desc"><?= $section['desc']; ?></div>
                                <?php endif; ?>
                                <?php if( $section['btn_label'] && $section['btn_url'] ): ?>
                                    <div class="product-tech__btn">
                                        <a class="btn" href="<?= $section['btn_url']; ?>" target="_blank"><?= $section['btn_label']; ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="product-tech__right col-lg">
                                <?php if( $section['banners'] ): ?>
                                    <div class="product-tech__blocks">
                                        <?php $counter = 1; foreach( $section['banners'] as $banner ): ?>
                                            <div class="product-tech__block" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                                                <div class="product-t-block product-t-block--<?= $banner['type']; ?>">
                                                    <?php if( $banner['bg'] ): ?>
                                                        <div class="product-t-block__bg">
                                                            <img src="<?= kama_thumb_src( 'wh=646:866', $banner['bg'] ); ?>" alt="Tech - BG <?= $img_counter; ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if( $banner['img'] ): ?>
                                                        <div class="product-t-block__img"><?= get_retina_img($banner['img'], 'Tech - Img ' . $img_counter); ?></div>
                                                    <?php endif; ?>
                                                    <?php if( $banner['sub'] ): ?>
                                                        <div class="product-t-block__sub h4"><?= $banner['sub']; ?></div>
                                                    <?php endif; ?>
                                                    <?php if( $banner['num'] ): ?>
                                                        <div class="product-t-block__num"><?= $banner['num']; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php $img_counter++; $counter++; endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if( $section['cards'] ): ?>
                            <div class="product-tech__cards">
                                <div class="product-tech__card-row">
                                    <?php foreach( $section['cards'] as $cards ): ?>
                                        <div class="product-tech__cards-col" data-aos="fade-up">
                                            <div class="product-tech__card">
                                                <?php if( $cards['icon'] ): ?>
                                                    <div class="product-tech__card-icon">
                                                        <img src="<?= $cards['icon']; ?>" alt="#">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="product-tech__card-content">
                                                    <?php if( $cards['desc'] ): ?>
                                                        <div class="product-tech__card-sub"><?= $cards['desc']; ?></div>
                                                    <?php endif; ?>
                                                    <?php if( $cards['sub'] ): ?>
                                                        <div class="product-tech__card-desc"><?= $cards['sub']; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if( $section['btn_label'] && $section['btn_url'] ): ?>
                            <div class="product-tech__mob-btn">
                                <a class="btn" href="<?= $section['btn_url']; ?>" target="_blank"><?= $section['btn_label']; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
