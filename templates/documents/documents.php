<?php
    get_header();
?>

<?php
    $documents_title = get_field('documents_title');
    $documents_items = get_field('documents_items');
?>
<section class="documentation">
    <div class="container">
        <h1 class="documentation__title h3" data-aos="fade-up"><?= $documents_title; ?></h1>
        <div class="documentation__row row-lg">
            <?php $counter = 1; foreach( $documents_items as $documents_item ): if($counter == 4) $counter = 1; ?>
                <div class="documentation__col col-lg" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                    <div class="documentation__item">
                        <div class="documentation__item-header">
                            <img src="<?= $documents_item['bg']; ?>" alt="<?= $documents_item['sub']; ?>">
                            <span><?= $documents_item['sub']; ?></span>
                        </div>
                        <div class="documentation__files">
                            <?php foreach( $documents_item['items'] as $documents_link ): ?>
                                <?php if( $documents_link['type'] == 'link' ): ?>
                                    <div class="documentation__files-col">
                                        <a class="media-file" href="<?= $documents_link['url']; ?>" target="_blank">
                                            <div class="media-file__file-icon js-svg-replace">
                                                <img src="<?= $documents_link['icon']; ?>" alt="#">
                                            </div>
                                            <div class="media-file__file-name"><?= $documents_link['label']; ?></div>
                                            <div class="media-file__icon">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/media-file-icon-2.svg" alt="Download">
                                            </div>
                                        </a>
                                    </div>
                                <?php elseif( $documents_link['type'] == 'file' ): ?>
                                    <div class="documentation__files-col">
                                        <a class="media-file" href="<?= $documents_link['file']; ?>" target="_blank">
                                            <div class="media-file__file-icon js-svg-replace">
                                                <img src="<?= $documents_link['icon']; ?>" alt="#">
                                            </div>
                                            <div class="media-file__file-name"><?= $documents_link['label']; ?></div>
                                            <div class="media-file__icon">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/media-file-icon.svg" alt="Download">
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php $counter++; endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>