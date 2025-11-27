<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'comments';
$class = isset($block['className']) ? $block['className'] : 'default';

$result = get_field_block('cases_results', $block);
?>

<section class="cases__results <?= $class ?> section aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
    <div class="container">
        <?php if ($result): ?>
            <div class="cases__results-content">
                <h2 class="cases__results-title h2"><?= $result['title']; ?></h2>
                <div class="cases__results-text h7">
                    <?= $result['text']; ?>
                </div>

                <?php if (!empty($result['result_number'])): ?>
                    <div class="cases__results-stats">
                        <?php foreach ($result['result_number'] as $stat): ?>
                            <div class="cases__results-stat-item">
                                <div class="cases__results-value h3"><?= $stat['value']; ?></div>
                                <div class="cases__results-label h7"><?= $stat['result_text']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
