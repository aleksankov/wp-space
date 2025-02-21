<?php
    $card_id = get_the_ID();
    $card_logo = get_field('matrix_logo');
    $card_solution = get_field('matrix_solution');
    $card_type = get_field('matrix_type');
    $card_vendor = get_field('matrix_vendor');

    if( $card_logo ){
        $card_logo_url = wp_get_upload_dir()['baseurl'] . '/vendors_logo/' . $card_logo;
    }else{
        $card_logo_url = get_template_directory_uri() . '/assets/img/def-logo.svg';
    }
?>
<div class="matrix__col col-lg">
    <a class="matrix-card" href="#matrix-popup-<?= $card_id; ?>" data-fancybox="" data-touch="false">
        <div class="matrix-card__img">
            <img src="<?= $card_logo_url; ?>" alt="<?= $card_vendor; ?>">
        </div>
        <div class="matrix-card__info">
            <?php if( $card_solution ): ?>
                <div class="matrix-card__sub"><?= $card_solution; ?></div>
            <?php endif; ?>
            <?php if( $card_type ): ?>
                <div class="matrix-card__desc"><?= $card_type; ?></div>
            <?php endif; ?>
        </div>
    </a>
</div>

<div class="matrix-popup" id="matrix-popup-<?= $card_id; ?>">
    <button class="matrix-popup__close" type="button" data-fancybox-close>
        <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
    </button>
    <div class="matrix-popup__wrap">
        <div class="matrix-popup__info">
            <?php if( $card_solution ): ?>
                <div class="matrix-popup__title h5"><?= $card_solution; ?></div>
            <?php endif; ?>
            <?php if( $card_type ): ?>
                <div class="matrix-popup__desc"><?= $card_type; ?></div>
            <?php endif; ?>
            <div class="matrix-popup__img">
                <img src="<?= $card_logo_url; ?>" alt="<?= $card_solution; ?>">
            </div>
            <?php if( false ): ?>
                <div class="matrix-popup__select">
                    <div class="filter-select main-scroll">
                        <select class="js-select js-select-scroll">
                            <option value="0">&nbsp;</option>
                            <option value="1" selected>SPACE VM 6.5.1</option>
                            <option value="2">SPACE VM 6.5.2</option>
                            <option value="3">SPACE VM 6.5.3</option>
                            <option value="4">SPACE VM 6.5.4</option>
                            <option value="5">SPACE VM 6.5.5</option>
                            <option value="6">SPACE VM 6.5.6</option>
                            <option value="7">SPACE VM 6.5.7</option>
                            <option value="8">SPACE VM 6.5.8</option>
                            <option value="9">SPACE VM 6.5.9</option>
                            <option value="10">SPACE VM 6.6.1</option>
                            <option value="11">SPACE VM 6.6.2</option>
                            <option value="12">SPACE VM 6.6.3</option>
                            <option value="13">SPACE VM 6.6.4</option>
                            <option value="14">SPACE VM 6.6.5</option>
                            <option value="15">SPACE VM 6.6.6</option>
                        </select>
                        <span class="js-select-toggle">Версия</span>
                    </div>
                </div>
                <div class="matrix-popup__models">
                    <div class="matrix-popup__models-sub">Список моделей оборудования</div>
                    <div class="matrix-popup__models-list">
                        <ul>
                            <li>Модель 1</li>
                            <li>Модель 2</li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>