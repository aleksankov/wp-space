<?php
// Isolated render checks: no WordPress connection, database writes or email.
$theme = dirname(__DIR__);
$fields = [];
$query_posts = [];
$checks = 0;
function check($condition, $message) {
    global $checks;
    $checks++;
    if (!$condition) { throw new RuntimeException($message); }
}
function get_field($name, $scope = null) { return $GLOBALS['fields'][$name] ?? false; }
function get_field_block($name, $block = null) { return get_field($name); }
function get_header() {}
function get_footer() {}
function get_template_directory() { return $GLOBALS['theme']; }
function get_template_directory_uri() { return '/theme'; }
function esc_attr($value) { return htmlspecialchars((string)$value, ENT_QUOTES); }
function esc_html($value) { return htmlspecialchars((string)$value, ENT_QUOTES); }
function esc_url($value) { return htmlspecialchars((string)$value, ENT_QUOTES); }
function sanitize_title($value) { return strtolower($value); }
function wp_get_attachment_image_src($id, $size) { return $id ? ['/banner.jpg'] : false; }
function get_tel_href($value) { return 'tel:' . $value; }
function get_retina_img($image, $alt) { return '<img src="' . esc_url($image) . '" alt="' . esc_attr($alt) . '">'; }
function wp_reset_postdata() {}
function setup_postdata($post) {}
function get_the_ID() { return $GLOBALS['fixture_post']->ID; }
function get_the_title() { return 'Fixture partner'; }
function get_template_part($path) { echo '<div class="fixture-partner">Partner</div>'; }
class WP_Query {
    public $posts;
    private $position = 0;
    function __construct($args) { $this->posts = $GLOBALS['query_posts']; }
    function have_posts() { return $this->position < count($this->posts); }
    function the_post() { $GLOBALS['fixture_post'] = $this->posts[$this->position++]; }
}
function render_fixture($path, $values = [], $posts = []) {
    $GLOBALS['fields'] = $values;
    $GLOBALS['query_posts'] = $posts;
    $args = [];
    ob_start();
    include $GLOBALS['theme'] . '/' . $path;
    return ob_get_clean();
}

$partner = 'functions/blocks/partner/template.php';
$html = render_fixture($partner);
check(trim($html) === '', 'Empty partners must render no section or empty-state message.');
$html = render_fixture($partner, ['status' => 'Gold'], [(object)['ID' => 5]]);
check(strpos($html, 'class="partner-block ') !== false, 'Published partner must render its section.');
check(substr_count($html, 'class="fixture-partner"') === 1, 'Published partner must render once.');

$card = ['logo'=>'/one.svg','tel'=>'','email'=>'','site_label'=>'one.example','site_url'=>'https://one.example'];
$html = render_fixture('templates/partners/partners.php', [
    'partners_distributors_title'=>'Distributor one', 'partners_distributors_cards'=>[$card],
    'partners_distributors_second_title'=>'Distributor two',
    'partners_distributors_second_cards'=>[array_replace($card, ['site_label'=>'two.example','site_url'=>'https://two.example'])],
]);
check(substr_count($html, 'class="partners-distributors section"') === 2, 'Two independent distributor groups must render.');
check(strpos($html, 'Distributor one') < strpos($html, 'Distributor two'), 'Distributor groups must retain their order.');
check(strpos($html, 'https://one.example') !== false && strpos($html, 'https://two.example') !== false, 'Each group must use its own website.');
$html = render_fixture('templates/partners/partners.php', [
    'partners_distributors_title'=>'Empty group', 'partners_distributors_cards'=>[],
    'partners_distributors_second_title'=>'Second only', 'partners_distributors_second_cards'=>[$card],
]);
check(substr_count($html, 'class="partners-distributors section"') === 1, 'Empty first group must not suppress the second group.');
check(strpos($html, 'Empty group') === false && strpos($html, 'Second only') !== false, 'Empty group heading must stay hidden.');

$banner = 'functions/blocks/banner-min/template.php';
$html = render_fixture($banner, ['banner-min-background'=>1,'banner-min-title'=>'Banner','banner-min-text'=>'']);
check(strpos($html, '<section class="banner-min ') !== false, 'Banner must render with empty text.');
check(strpos($html, 'class="banner-min__text"') === false, 'Empty banner text wrapper must be omitted.');
$html = render_fixture($banner, ['banner-min-background'=>1,'banner-min-title'=>'Banner','banner-min-text'=>'Body']);
check(strpos($html, 'class="banner-min__text">Body') !== false, 'Filled banner text must remain visible.');
$html = render_fixture($banner, ['banner-min-background'=>false,'banner-min-title'=>'Banner']);
check(trim($html) === '', 'Banner without required background must remain hidden.');

// Render the real demo section in isolation, with the current form API stubbed.
function absint($value) { return abs((int)$value); }
function wp_kses_post($value) { return (string)$value; }
function wp_get_attachment_image($id, $size, $icon, $attrs) {
    return '<img data-attachment="' . (int)$id . '" alt="' . esc_attr($attrs['alt']) . '">';
}
function space_form_get_option_source_config($name, $defaults) { return $defaults + ['submit_label'=>'Send']; }
function space_form_get_agreement_text($config) { return ''; }
function space_form_render_fields($config, $context) { echo '<input name="fixture-form-field">'; }
function space_form_render_agreement($config, $class) {}
function space_form_render_security_fields($config) { echo '<input name="fixture-form-signature">'; }
function render_demo_fixture($values, $globals = []) {
    $GLOBALS['fields'] = $values;
    $site_soc_yt = $globals['youtube'] ?? '';
    $site_soc_rutube = $globals['rutube'] ?? '';
    $site_soc_tg = $globals['telegram'] ?? '';
    $site_soc_habr = $globals['habr'] ?? '';
    $source = file_get_contents($GLOBALS['theme'] . '/templates/homepage/homepage.php');
    preg_match("~\\\$home_regions_title = get_field\\('home_demo_title'\\);.*?(?=<\\?php\\s*\\\$home_portfolio_sub = )~s", $source, $matches);
    if (!$matches) { throw new RuntimeException('Demo section was not found in homepage.'); }
    $temporary = tempnam(sys_get_temp_dir(), 'space-demo-test-');
    file_put_contents($temporary, '<?php ' . $matches[0]);
    ob_start();
    try { include $temporary; return ob_get_contents(); }
    finally { ob_end_clean(); unlink($temporary); }
}
$socials = [
    ['url'=>'https://first.example','text'=>'First social','icon'=>['ID'=>12],'bg'=>13],
    ['url'=>'https://second.example','text'=>'Second social','icon'=>14,'bg'=>0],
];
$values = ['home_demo_title'=>'Demo','home_demo_desc_yt'=>'Legacy video','home_demo_socials'=>$socials];
$html = render_demo_fixture($values, ['youtube'=>'https://legacy.example']);
check(substr_count($html, 'class="demo__soc-col"') === 2, 'Managed social count must match the repeater.');
check(strpos($html, 'https://first.example') !== false && strpos($html, 'First social') !== false, 'Managed social link and text must render.');
check(strpos($html, 'data-attachment="12"') !== false && strpos($html, 'data-attachment="14"') !== false, 'Each managed social must use its own icon.');
check(strpos($html, 'https://legacy.example') === false, 'Managed socials must replace global fallback.');
check(strpos($html, 'fixture-form-signature') !== false, 'The current form API must still render its security fields.');
$values['home_demo_socials'] = [$socials[1]];
$html = render_demo_fixture($values);
check(substr_count($html, 'class="demo__soc-col"') === 1 && strpos($html, 'https://first.example') === false, 'Removing a social must change only the selected list.');
$values['home_demo_socials'] = [];
$html = render_demo_fixture($values, ['youtube'=>'https://legacy.example']);
check(substr_count($html, 'class="demo__soc-col"') === 1 && strpos($html, 'https://legacy.example') !== false, 'Empty repeater must preserve the documented global fallback.');
$html = render_demo_fixture($values);
check(strpos($html, 'demo__right col-lg') === false, 'No managed or fallback socials must hide the empty column.');
check(strpos($html, 'demo__left--wide') !== false, 'The form must expand when the social column is hidden.');

// Exercise category membership rather than searching the implementation text.
function add_filter(...$args) {}
function add_action(...$args) {}
function is_wp_error($value) { return false; }
function get_term_meta($id, $name, $single) { return ''; }
function get_terms($args) { return $GLOBALS['fixture_terms']; }
function wp_list_pluck($items, $field) { return array_map(fn($item) => $item->$field, $items); }
include $theme . '/functions/blog-category-sections.php';
$GLOBALS['fixture_terms'] = [
    (object)['term_id'=>1,'slug'=>'news'],
    (object)['term_id'=>2,'slug'=>'articles'],
    (object)['term_id'=>3,'slug'=>'media'],
];
$GLOBALS['fields'] = [];
check(space_get_blog_category_term_ids('news') === [1], 'Legacy news category must retain its section.');
check(space_get_blog_category_term_ids('blog') === [2,3], 'Unassigned non-news categories must retain blog fallback.');
$GLOBALS['fields']['blog_category_section'] = 'news';
check(space_get_blog_category_term_ids('news') === [1,2,3], 'Explicit news membership must override legacy fallback.');
check(space_get_blog_category_term_ids('blog') === [], 'Explicit news categories must not leak into blog tabs.');
echo "PASS: {$checks} restored-section render and category checks.\n";
