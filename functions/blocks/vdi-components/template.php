<?php
$title = get_field('vdi-components-title');
$list = get_field('vdi-components-list');
?>

<?php if (!empty($list)) : ?>
    <section class="vdi-components section">
        <div class="container">
            <div class="vdi-components__container">
                <h2 class="vdi-components__title h4">
                    <?php if (!empty($title)): ?>
                        <?= $title; ?>
                    <?php else : ?>
                        Состав продукта <span>Space VDI</span>
                    <?php endif; ?>
                </h2>

                <div class="vdi-components__content">
                    <div class="vdi-components__list">
                        <?php foreach ($list as $item): ?>
                            <div class="vdi-components__item">
                                <div class="vdi-components__header">
                                    <?php if(!empty($item['label'])) : ?>
                                        <span class="vdi-components__label"><?= $item['label'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="vdi-components__footer">
                                    <?php if(!empty($item['text'])) : ?>
                                        <span class="vdi-components__name"><?= $item['text'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>