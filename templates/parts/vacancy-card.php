<?php
    $card_id = get_the_ID();

    $cities = get_the_terms( $card_id, 'vacancies_city' );

    $cities_html = '';
    if( $cities ){
        foreach( $cities as $city ){
            $cities_arr[] = $city->name;
        }
        $cities_html = implode(', ', $cities_arr);
    }
?>
<div class="vacancies__col col-lg">
    <a class="vacancy-card" href="<?php the_permalink(); ?>">
        <div class="vacancy-card__sub"><?php the_title(); ?></div>
        <?php if( $cities_html ): ?>
            <div class="vacancy-card__location"><?= $cities_html; ?></div>
        <?php endif; ?>
    </a>
</div>