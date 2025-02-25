<?php
    $color = get_field('color');
    $title = get_field('title');
    $sections = get_field('sections');
?>

<?php if( $color ): ?>
    <style>
        .platform-video-card__sub{
            color: <?= $color; ?>;
        }
        .platform-video-card{
            background-color: <?= $color; ?>;
        }
    </style>
<?php endif; ?>

<?php if( $sections ): ?>
    <section class="platform-video section">
        <div class="container" id="video">
            <?php if( $title ): ?>
                <h2 class="platform-video__title" data-aos="fade-up"><?= $title; ?></h2>
            <?php endif; ?>
            <div class="platform-video__tags" data-aos="fade-up">
                <div class="main-tags main-tags--violet">
                    <div class="main-tags__row">
                        <?php $counter = 1; foreach( $sections as $section ): ?>
                            <button class="main-tags__item js-platform-video-tag<?= $counter == 1 ? ' active' : ''; ?>" type="button"><?= $section['label']; ?></button>
                        <?php $counter++; endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="platform-video__variations" data-aos="fade-up">
                <?php $img_counter = 1; $counter = 1; foreach( $sections as $section ): ?>
                    <div class="platform-video__variation js-platform-video-variation"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                        <div class="platform-video__slider swiper-container">
                            <div class="swiper-wrapper">
                                <?php foreach( $section['cards'] as $card ): ?>
                                    <div class="platform-video__slide swiper-slide">
                                        <div class="platform-video-card">
                                            <div class="platform-video-card__bg">
                                                <?php if( $card['img'] ): ?>
                                                    <div class="platform-video-card__bg-item">
                                                        <img src="<?= kama_thumb_src( 'wh=1136:1136', $card['img'] ); ?>" alt="Video - Img <?= $img_counter; ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="platform-video-card__content">
                                                <?php if( $card['title'] ): ?>
                                                    <h3 class="platform-video-card__sub h2"><?= $card['title']; ?></h3>
                                                <?php endif; ?>
                                                <div class="platform-video-card__bottom">
                                                    <?php if( $card['desc'] ): ?>
                                                        <div class="platform-video-card__desc"><?= $card['desc']; ?></div>
                                                    <?php endif; ?>
                                                    <?php if( $card['link'] ): ?>
                                                        <div class="platform-video-card__btn">
                                                            <a class="play-btn" href="<?= $card['link']; ?>" target="_blank">
                                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                                <span>Смотреть</span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $img_counter++; endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
