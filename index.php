<?php
/**
 * Этот шаблон используется, когда не нашлось подходящего (свёрстанного для проекта).
 */

if ( ! current_user_can( 'update_core' ) ) {
	return;
}

get_header();
?>
    <div class="container">
        <h2 class="h1" id="title-header">Template missing</h2>
    </div>

	<script>
		// Query Monitor Template List
		addEventListener('load', function () {
			let h2 = document.querySelector("#title-header");
			let box = document.querySelector("#qm-response > div > section:nth-child(3) > ol");

			if (box && h2) {
				h2.after(box.cloneNode(true));
			}
		})
	</script>

<?php
get_footer();