<?php
    get_header();
?>

<?php
    $press_hero_img = get_field('press_hero_img');
    $press_hero_name = get_field('press_hero_name');
    $press_hero_position = get_field('press_hero_position');
    $press_hero_title = get_field('press_hero_title');
    $press_hero_desc = get_field('press_hero_desc');
    $press_hero_phone = get_field('press_hero_phone');
    $press_hero_email = get_field('press_hero_email');
    $press_hero_btn_label = get_field('press_hero_btn_label');
    $press_hero_btn_url = get_field('press_hero_btn_url');

    if( $press_hero_img && $press_hero_title ):
?>
    <section class="press-hero" data-aos="fade-up">
        <div class="press-hero__wrap">
            <div class="container">
                <div class="press-hero__row">
                    <div class="press-hero__left press-hero__col">
                        <div class="press-hero__img">
                            <img src="<?= kama_thumb_src( 'wh=1168:1168', $press_hero_img ); ?>" alt="<?php the_title(); ?>">
                            <div class="press-hero__img-info">
                                <?php if( $press_hero_name ): ?>
                                    <div class="press-hero__img-name h2"><?= $press_hero_name; ?></div>
                                <?php endif; ?>
                                <?php if( $press_hero_position ): ?>
                                    <div class="press-hero__img-desc"><?= $press_hero_position; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="press-hero__right press-hero__col">
                        <h1 class="press-hero__sub h3"><?= $press_hero_title; ?></h1>
                        <?php if( $press_hero_desc ): ?>
                            <div class="press-hero__text h4"><?= $press_hero_desc; ?></div>
                        <?php endif; ?>
                        <div class="press-hero__bottom">
                            <div class="press-hero__contacts">
                                <?php if( $press_hero_phone ): ?>
                                    <a class="press-hero__contacts-item" href="<?= get_tel_href($press_hero_phone); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M8.38028 8.85335C9.07627 10.303 10.0251 11.6616 11.2266 12.8632C12.4282 14.0648 13.7869 15.0136 15.2365 15.7096C15.3612 15.7694 15.4235 15.7994 15.5024 15.8224C15.7828 15.9041 16.127 15.8454 16.3644 15.6754C16.4313 15.6275 16.4884 15.5704 16.6027 15.4561C16.9523 15.1064 17.1271 14.9316 17.3029 14.8174C17.9658 14.3864 18.8204 14.3864 19.4833 14.8174C19.6591 14.9316 19.8339 15.1064 20.1835 15.4561L20.3783 15.6509C20.9098 16.1824 21.1755 16.4481 21.3198 16.7335C21.6069 17.301 21.6069 17.9713 21.3198 18.5389C21.1755 18.8242 20.9098 19.09 20.3783 19.6214L20.2207 19.779C19.6911 20.3087 19.4263 20.5735 19.0662 20.7757C18.6667 21.0001 18.0462 21.1615 17.588 21.1601C17.1751 21.1589 16.8928 21.0788 16.3284 20.9186C13.295 20.0576 10.4326 18.4332 8.04466 16.0452C5.65668 13.6572 4.03221 10.7948 3.17124 7.76144C3.01103 7.19699 2.93092 6.91477 2.9297 6.50182C2.92833 6.0436 3.08969 5.42311 3.31411 5.0236C3.51636 4.66357 3.78117 4.39876 4.3108 3.86913L4.46843 3.7115C4.99987 3.18006 5.2656 2.91433 5.55098 2.76999C6.11854 2.48292 6.7888 2.48292 7.35636 2.76999C7.64174 2.91433 7.90747 3.18006 8.43891 3.7115L8.63378 3.90637C8.98338 4.25597 9.15819 4.43078 9.27247 4.60655C9.70347 5.26945 9.70347 6.12403 9.27247 6.78692C9.15819 6.96269 8.98338 7.1375 8.63378 7.4871C8.51947 7.60142 8.46231 7.65857 8.41447 7.72538C8.24446 7.96281 8.18576 8.30707 8.26748 8.58743C8.29048 8.66632 8.32041 8.72866 8.38028 8.85335Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span><?= $press_hero_phone; ?></span>
                                    </a>
                                <?php endif; ?>
                                <?php if( $press_hero_email ): ?>
                                    <a class="press-hero__contacts-item" href="mailto:<?= $press_hero_email; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M2 7L10.1649 12.7154C10.8261 13.1783 11.1567 13.4097 11.5163 13.4993C11.8339 13.5785 12.1661 13.5785 12.4837 13.4993C12.8433 13.4097 13.1739 13.1783 13.8351 12.7154L22 7M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span><?= $press_hero_email; ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php if( $press_hero_btn_label && $press_hero_btn_url ): ?>
                                <div class="press-hero__btn">
                                    <a class="btn" href="<?= $press_hero_btn_url; ?>"><?= $press_hero_btn_label; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $press_news_title = get_field('press_news_title');
    $press_news_btn_label = get_field('press_news_btn_label');
    $press_news_btn_url = get_field('press_news_btn_url');

    $news_arr = [];
    $args = array(
        'post_type' => 'blog',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'blog_category',
                'field' => 'slug',
                'terms' => 'news'
            )
        )
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ){
        while( $query->have_posts() ){
            $query->the_post();
            
            $news_arr[] = get_the_ID();
        }
        wp_reset_postdata();
    }

    if( $news_arr && count($news_arr) == 4):
?>
    <section class="home-news section">
        <div class="container">
            <?php if( $press_news_title ): ?>
                <h2 class="home-news__title" data-aos="fade-up"><?= $press_news_title; ?></h2>
            <?php endif; ?>
            <div class="home-news__row row-lg">
                <div class="home-news__left col-lg" data-aos="fade-up">
                    <?php get_template_part( 'templates/parts/news-card-lg', null, ['card_id' => $news_arr[0]] ); ?>
                </div>
                <div class="home-news__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="home-news__list">
                        <?php foreach( $news_arr as $news_item ): ?>
                            <div class="home-news__col">
                                <?php get_template_part( 'templates/parts/news-card-small', null, ['card_id' => $news_item] ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if( $press_news_btn_label && $press_news_btn_url ): ?>
                <div class="home-news__btn">
                    <a class="btn" href="<?= $press_news_btn_url; ?>"><?= $press_news_btn_label; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
    $press_team_title = get_field('press_team_title');
    $press_team_desc = get_field('press_team_desc');
    $press_team_btn_label = get_field('press_team_btn_label');
    $press_team_btn_url = get_field('press_team_btn_url');
    $press_team_items = get_field('press_team_items');

    if( $press_team_items ):
?>
    <section class="team section">
        <div class="container">
            <?php if( $press_team_title || $press_team_desc ): ?>
                <div class="team__header">
                    <?php if( $press_team_title ): ?>
                        <h2 class="team__title" data-aos="fade-up"><?= $press_team_title; ?></h2>
                    <?php endif; ?>
                    <?php if( $press_team_desc ): ?>
                        <div class="team__desc" data-aos="fade-up" data-aos-delay="200"><?= $press_team_desc; ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="team__wrap">
                <div class="team__tabs" data-aos="fade-up">
                    <?php $counter = 1; foreach( $press_team_items as $press_team_item ): ?>
                        <button class="team__tab h7 js-team-tab<?= $counter == 1 ? ' active' : ''; ?>" type="button"><?= $press_team_item['position'] ?></button>
                    <?php $counter++; endforeach; ?>
                </div>
                <div class="team__blocks" data-aos="fade-up" data-aos-delay="200">
                    <div class="team__blocks-row">
                        <?php $counter = 1; foreach( $press_team_items as $press_team_item ): ?>
                            <?php
                                $press_team_item['desc'] = str_replace('<p>', '<li>', $press_team_item['desc']);
                                $press_team_item['desc'] = str_replace('</p>', '</li>', $press_team_item['desc']);    
                            ?>
                            <div class="team__block js-team-block<?= $counter == 1 ? ' active' : ''; ?>">
                                <div class="team__block-img">
                                    <img src="<?= kama_thumb_src( 'wh=540:986', $press_team_item['img'] ); ?>" alt="<?= $press_team_item['name']; ?>">
                                </div>
                                <div class="team__block-info">
                                    <div class="team__block-name h5"><?= $press_team_item['name']; ?></div>
                                    <div class="team__block-position"><?= $press_team_item['position']; ?></div>
                                    <div class="team__block-about">
                                        <div class="team__block-label">Чем может помочь</div>
                                        <div class="team__block-list">
                                            <ul>
                                                <?= $press_team_item['desc']; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="team__slider swiper-container" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <?php foreach( $press_team_items as $press_team_item ): ?>
                        <?php
                            $press_team_item['desc'] = str_replace('<p>', '<li>', $press_team_item['desc']);
                            $press_team_item['desc'] = str_replace('</p>', '</li>', $press_team_item['desc']);    
                        ?>
                        <div class="team__slide swiper-slide">
                            <div class="team__card">
                                <div class="team__card-img">
                                    <img src="<?= kama_thumb_src( 'wh=200:200', $press_team_item['img_mob'] ); ?>" alt="<?= $press_team_item['name']; ?>">
                                </div>
                                <div class="team__card-name h3"><?= $press_team_item['name']; ?></div>
                                <div class="team__card-position"><?= $press_team_item['position']; ?></div>
                                <div class="team__card-about">
                                    <div class="team__card-label">Чем может помочь</div>
                                    <div class="team__card-list">
                                        <ul><?= $press_team_item['desc']; ?></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="team__pagination gallery-pagination"></div>
            </div>
            <?php if( $press_team_btn_label && $press_team_btn_url ): ?>
                <div class="team__btn">
                    <a class="btn" href="<?= $press_team_btn_url; ?>" target="_blank"><?= $press_team_btn_label; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
    $press_media_title = get_field('press_media_title');
    $press_media_desc = get_field('press_media_desc');
    $press_media_items = get_field('press_media_items');

    if( $press_media_title && $press_media_items ):
?>
    <section class="home-media section">
        <div class="container">
            <h2 class="home-media__title" data-aos="fade-up"><?= $press_media_title; ?></h2>
            <?php if( $press_media_desc ): ?>
                <div class="home-media__desc" data-aos="fade-up"><?= $press_media_desc; ?></div>
            <?php endif; ?>
            <div class="home-media__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $press_media_items as $press_media_item ): ?>
                        <div class="home-media__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= ($counter - 1) * 200; ?>">
                            <a class="home-media__card" href="<?= $press_media_item['url']; ?>" target="_blank">
                                <div class="home-media__card-text"><?= $press_media_item['text']; ?></div>
                                <div class="home-media__card-logo"><?= get_retina_img($press_media_item['logo'], 'SMI - Logo ' . $counter); ?></div>
                                <div class="home-media__card-btn">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/home-media-arrow.svg" alt="Arrow">
                                </div>
                            </a>
                        </div>
                    <?php $counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $press_kit_img = get_field('press_kit_img');
    $press_kit_title = get_field('press_kit_title');
    $press_kit_desc = get_field('press_kit_desc');
    $press_kit_items = get_field('press_kit_items');

    if( $press_kit_items ):
?>
    <section class="faq faq--media section">
        <div class="container">
            <div class="faq__wrap">
                <?php if( $press_kit_img && $press_kit_title ): ?>
                    <div class="faq__left" data-aos="fade-up">
                        <div class="faq__block faq__block--reverse">
                            <div class="faq__block-bg">
                                <img src="<?= $press_kit_img; ?>" alt="<?= $press_kit_title; ?>">
                            </div>
                            <h2 class="faq__block-title"><?= $press_kit_title; ?></h2>
                            <div class="faq__block-desc"><?= $press_kit_desc; ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="faq__right" data-aos="fade-up" data-aos-delay="200">
                    <div class="faq__list">
                        <?php foreach( $press_kit_items as $press_kit_item ): ?>
                            <?php if( $press_kit_item['type'] == 'file' ): ?>
                                <div class="faq__col">
                                    <a class="faq__item faq__item--media" href="<?= $press_kit_item['file']; ?>" target="_blank">
                                        <div class="faq__toggle h5">
                                            <span><?= $press_kit_item['label']; ?></span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/media-download.svg" alt="Download">
                                        </div>
                                    </a>
                                </div>
                            <?php elseif( $press_kit_item['type'] == 'dropdown' ): ?>
                                <div class="faq__col">
                                    <div class="faq__item faq__item--media">
                                        <div class="faq__toggle h5 js-faq-toggle">
                                            <span><?= $press_kit_item['label']; ?></span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/faq-arrow-lg.svg" alt="Arrow">
                                        </div>
                                        <div class="faq__dropdown js-faq-dropdown">
                                            <div class="faq__content">
                                                <div class="faq__files">
                                                    <?php foreach( $press_kit_item['items'] as $press_kit_li ): ?>
                                                        <div class="faq__files-col">
                                                            <a class="media-file" href="<?= $press_kit_li['file']; ?>" target="_blank">
                                                                <div class="media-file__file-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M14 2.26953V6.40007C14 6.96012 14 7.24015 14.109 7.45406C14.2049 7.64222 14.3578 7.7952 14.546 7.89108C14.7599 8.00007 15.0399 8.00007 15.6 8.00007H19.7305M14 17H8M16 13H8M20 9.98822V17.2C20 18.8802 20 19.7202 19.673 20.362C19.3854 20.9265 18.9265 21.3854 18.362 21.673C17.7202 22 16.8802 22 15.2 22H8.8C7.11984 22 6.27976 22 5.63803 21.673C5.07354 21.3854 4.6146 20.9265 4.32698 20.362C4 19.7202 4 18.8802 4 17.2V6.8C4 5.11984 4 4.27976 4.32698 3.63803C4.6146 3.07354 5.07354 2.6146 5.63803 2.32698C6.27976 2 7.11984 2 8.8 2H12.0118C12.7455 2 13.1124 2 13.4577 2.08289C13.7638 2.15638 14.0564 2.27759 14.3249 2.44208C14.6276 2.6276 14.887 2.88703 15.4059 3.40589L18.5941 6.59411C19.113 7.11297 19.3724 7.3724 19.5579 7.67515C19.7224 7.94356 19.8436 8.2362 19.9171 8.5423C20 8.88757 20 9.25445 20 9.98822Z" stroke="#665F6D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </div>
                                                                <div class="media-file__file-name"><?= $press_kit_li['label']; ?></div>
                                                                <div class="media-file__icon">
                                                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/media-file-icon.svg" alt="Download">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>