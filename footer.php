<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    global $site_soc_tg;
    global $site_soc_yt;
    global $site_soc_vk;
    global $site_soc_habr;
    global $site_soc_rutube;

    global $site_contacts_addresses;

    $site_contacts_copy = get_field('site_contacts_copy', 'option');
    $site_contacts_footer_logos = get_field('site_contacts_footer_logos', 'option');
    
    $site_footer_menu = get_field('site_footer_menu', 'option');

    global $site_forms_agree;
    global $form_product_options;
    global $form_partner_options;
    global $form_production_options;

    global $site_feedback_main_email;
    global $site_feedback_partner_email;
    global $site_feedback_tech_partner_email;
?>
    </main>
    <footer class="footer js-footer">
        <div class="container">
            <div class="footer__top">
                <div class="footer__row row-lg">
                    <?php if( $site_footer_menu ): $counter = 1; foreach( $site_footer_menu as $site_footer_col ): ?>
                        <?php
                            if( $counter === 1 ){
                                $footer_menu_col_class = 'footer__product';
                            }elseif( $counter === 2 ){
                                $footer_menu_col_class = 'footer__about';
                            }else{
                                $footer_menu_col_class = 'footer__other';
                            }
                        ?>
                        <div class="footer__col <?= $footer_menu_col_class; ?> col-lg">
                            <nav class="footer__nav">
                                <ul>
                                    <?php foreach( $site_footer_col as $site_footer_ul ): foreach( $site_footer_ul as $site_footer_li ): ?>
                                        <?php if( $site_footer_li['url'] ): ?>
                                            <li>
                                                <a href="<?= $site_footer_li['url']; ?>"><?= $site_footer_li['label']; ?></a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <span><?= $site_footer_li['label']; ?></span>
                                                <?php if( $site_footer_li['items'] ): ?>
                                                    <ul>
                                                        <?php foreach( $site_footer_li['items'] as $site_footer_item ): ?>
                                                            <li>
                                                                <a href="<?= $site_footer_item['url']; ?>"><?= $site_footer_item['label']; ?></a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; endforeach; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php $counter++; endforeach; endif; ?>
                    <?php if( $site_contacts_addresses ): ?>
                        <div class="footer__contacts footer__col col-lg">
                            <div class="footer__contacts-sub">Контакты</div>
                            <div class="footer__contacts-info">
                                <?php foreach( $site_contacts_addresses as $site_contacts_address ): ?>
                                    <p><?= $site_contacts_address['city']; ?>, <?= $site_contacts_address['address']; ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__soc">
                    <div class="footer__soc-label">Социальные сети</div>
                    <div class="footer__soc-row">
                        <?php if( $site_soc_tg ): ?>
                            <a class="footer__soc-item" href="<?= $site_soc_tg; ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24Z" fill="#5D5564" />
                                    <path d="M8.11719 12.8783L9.54089 16.8189C9.54089 16.8189 9.71889 17.1876 9.90949 17.1876C10.1001 17.1876 12.935 14.2384 12.935 14.2384L16.0875 8.14941L8.16799 11.8611L8.11719 12.8783Z" fill="#5D5564" />
                                    <path d="M10.0086 13.8877L9.73525 16.7923C9.73525 16.7923 9.62085 17.6823 10.5107 16.7923C11.4005 15.9023 12.2522 15.216 12.2522 15.216" fill="white" />
                                    <path d="M8.1492 13.0178L5.2206 12.0636C5.2206 12.0636 4.8706 11.9216 4.9833 11.5996C5.0065 11.5332 5.0533 11.4767 5.1933 11.3796C5.8422 10.9273 17.2039 6.84359 17.2039 6.84359C17.2039 6.84359 17.5247 6.73549 17.7139 6.80739C17.7607 6.82188 17.8028 6.84854 17.8359 6.88465C17.8691 6.92076 17.892 6.96501 17.9024 7.01289C17.9228 7.09746 17.9314 7.18446 17.9278 7.27139C17.9269 7.34659 17.9178 7.41629 17.9109 7.52559C17.8417 8.64209 15.7709 16.9749 15.7709 16.9749C15.7709 16.9749 15.647 17.4625 15.2031 17.4792C15.094 17.4827 14.9853 17.4642 14.8835 17.4249C14.7817 17.3855 14.6889 17.326 14.6106 17.25C13.7395 16.5007 10.7287 14.4773 10.0634 14.0323C10.0484 14.0221 10.0358 14.0087 10.0263 13.9932C10.0169 13.9777 10.0109 13.9603 10.0088 13.9423C9.9995 13.8954 10.0505 13.8373 10.0505 13.8373C10.0505 13.8373 15.2931 9.17729 15.4326 8.68809C15.4434 8.65019 15.4026 8.63149 15.3478 8.64809C14.9996 8.77619 8.9634 12.5881 8.2972 13.0088C8.24924 13.0233 8.19856 13.0264 8.1492 13.0178Z" fill="white" />
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if( $site_soc_yt ): ?>
                            <a class="footer__soc-item" href="<?= $site_soc_yt; ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="24" viewBox="0 0 36 24" fill="none">
                                    <rect x="11.9277" y="6.95752" width="10.9337" height="11.9277" fill="white" />
                                    <path d="M18.2331 23.9903L11.0691 23.8599C8.74953 23.8146 6.42423 23.9053 4.15022 23.4349C0.690765 22.7321 0.445696 19.2863 0.189229 16.3958C-0.164125 12.3323 -0.0273428 8.19499 0.639471 4.16541C1.01562 1.90408 2.49743 0.555214 4.78854 0.407859C12.5224 -0.124885 20.3076 -0.0625424 28.0244 0.186827C28.8394 0.209497 29.6601 0.334182 30.4637 0.475869C34.4304 1.1673 34.5273 5.0722 34.7838 8.35935C35.0402 11.6805 34.932 15.0187 34.4418 18.3171C34.0486 21.0489 33.2963 23.3385 30.1218 23.5596C26.1437 23.8486 22.2568 24.081 18.2673 24.0073C18.2673 23.9903 18.2445 23.9903 18.2331 23.9903ZM14.0213 17.0759C17.0192 15.3644 19.96 13.6811 22.9407 11.9809C19.9372 10.2693 17.0021 8.58605 14.0213 6.8858V17.0759Z" fill="#5D5564" />
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if( $site_soc_vk ): ?>
                            <a class="footer__soc-item" href="<?= $site_soc_vk; ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                    <path d="M0.783203 11.52C0.783203 6.0894 0.783203 3.37413 2.47027 1.68707C4.15733 0 6.8726 0 12.3032 0H13.2632C18.6938 0 21.4091 0 23.0962 1.68707C24.7832 3.37413 24.7832 6.0894 24.7832 11.52V12.48C24.7832 17.9106 24.7832 20.6259 23.0962 22.313C21.4091 24 18.6938 24 13.2632 24H12.3032C6.8726 24 4.15733 24 2.47027 22.313C0.783203 20.6259 0.783203 17.9106 0.783203 12.48V11.52Z" fill="#5D5564" />
                                    <path d="M13.552 17.2898C8.08198 17.2898 4.96203 13.5398 4.83203 7.2998H7.57203C7.66203 11.8798 9.68198 13.8198 11.282 14.2198V7.2998H13.8621V11.2498C15.4421 11.0798 17.1019 9.2798 17.6619 7.2998H20.2419C19.8119 9.7398 18.0119 11.5398 16.7319 12.2798C18.0119 12.8798 20.062 14.4498 20.842 17.2898H18.0019C17.3919 15.3898 15.8721 13.9198 13.8621 13.7198V17.2898H13.552Z" fill="white" />
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if( $site_soc_habr ): ?>
                            <a class="footer__soc-item" href="<?= $site_soc_habr; ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="69" height="24" viewBox="0 0 69 24" fill="none">
                                    <path d="M0.783203 0C2.46047 0.0019419 4.13773 0 5.81309 0.0019419C5.80545 3.07209 5.8341 6.14224 5.79972 9.21434C6.57531 8.17348 7.71959 7.42002 8.98805 7.18699C10.822 6.88794 12.8851 7.2433 14.2262 8.64148C15.4316 9.79302 15.8767 11.5233 15.8958 13.1564C15.9053 16.6208 15.8977 20.0832 15.8996 23.5475C14.2223 23.5495 12.5451 23.5495 10.8678 23.5475C10.8678 20.7259 10.8678 17.9044 10.8678 15.0847C10.8487 14.2186 10.7494 13.2496 10.1171 12.6068C9.13514 11.5524 7.25156 11.7175 6.39001 12.8476C5.9258 13.4904 5.80927 14.3118 5.815 15.0905V23.5475C4.13773 23.5495 2.46047 23.5475 0.785113 23.5495C0.783203 15.7003 0.783203 7.84918 0.783203 0ZM38.6095 0C40.283 0 41.9564 0 43.6318 0.0019419C43.6318 3.02549 43.6413 6.04903 43.6241 9.07258C44.4819 8.06861 45.6663 7.3035 46.9863 7.16174C49.1144 6.82579 51.3514 7.59479 52.8587 9.1522C56.196 12.6399 56.1138 18.9588 52.5205 22.2309C50.9197 23.7553 48.5681 24.2796 46.4476 23.8291C45.2498 23.5534 44.1934 22.8154 43.4293 21.8484C43.4408 22.4154 43.4388 22.9805 43.4388 23.5475C41.8284 23.5495 40.218 23.5475 38.6095 23.5495C38.6057 15.7003 38.6057 7.85112 38.6095 0ZM45.9261 12.2029C44.3558 12.6088 43.1829 14.238 43.4217 15.8964C43.5344 17.6131 45.1199 19.0404 46.8144 18.9277C48.7648 19.0112 50.4383 17.0441 50.1021 15.0944C49.9282 13.1137 47.8001 11.6495 45.9261 12.2029ZM19.7069 10.6416C20.9524 8.49777 23.3365 7.03552 25.8104 7.09572C27.5526 7.00057 29.2146 7.89578 30.3149 9.23376C30.3111 8.66478 30.3111 8.0958 30.3149 7.52682H35.1442C35.1442 12.869 35.148 18.2092 35.1404 23.5495C33.5319 23.5475 31.9234 23.5495 30.3149 23.5475C30.313 22.9688 30.3111 22.3902 30.3226 21.8134C29.4916 22.7863 28.4103 23.6194 27.1304 23.8291C24.519 24.4758 21.6936 23.2329 20.1348 21.0619C18.022 18.0714 17.894 13.8089 19.7088 10.6416H19.7069ZM25.8772 12.2728C24.5381 12.7078 23.5199 14.0555 23.56 15.5003C23.5103 17.0829 24.6737 18.5957 26.2154 18.8734C28.2938 19.4229 30.5308 17.5043 30.2882 15.3158C30.2347 13.1642 27.864 11.5058 25.8772 12.2728ZM62.7599 9.3561C63.5221 8.22008 64.7141 7.27632 66.0972 7.14621C66.932 7.03358 67.7821 7.08018 68.6016 7.27826C68.6265 8.99879 68.6016 10.7193 68.3953 12.4301C67.337 12.1272 66.2348 11.8883 65.1325 12.0301C63.9443 12.1719 62.9643 13.3156 62.9719 14.5274C62.9891 17.5354 62.9796 20.5415 62.9796 23.5495C61.3004 23.5495 59.6212 23.5456 57.9439 23.5495C57.9325 18.2073 57.9439 12.8671 57.9382 7.52488H62.7675C62.7675 8.13464 62.7713 8.7444 62.7599 9.35415V9.3561Z" fill="#5D5564" />
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if( $site_soc_rutube ): ?>
                            <a class="footer__soc-item" href="<?= $site_soc_rutube; ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="136" height="24" viewBox="0 0 136 24" fill="none">
                                    <path d="M15.7174 6.98796H0.892578V24.0002H5.01879V18.4655H12.9254L16.5326 24.0002H21.153L17.1749 18.44C18.4103 18.2358 19.2999 17.7512 19.8435 16.9861C20.3871 16.2209 20.6588 14.9967 20.6588 13.3643V12.089C20.6588 11.1197 20.56 10.3546 20.3871 9.76797C20.214 9.18134 19.9176 8.6712 19.4975 8.21222C19.0527 7.77858 18.5587 7.47243 17.9657 7.26844C17.3727 7.08995 16.6314 6.98796 15.7171 6.98796H15.7174ZM15.0503 14.716H5.01863V10.7372H15.0505C15.6188 10.7372 16.014 10.8392 16.2118 11.0177C16.4091 11.1962 16.5326 11.5279 16.5326 12.0125V13.4408C16.5326 13.9509 16.4091 14.2825 16.2114 14.461C16.0138 14.6395 15.6185 14.716 15.0503 14.716ZM26.7294 18.9755V6.98779H22.6032V18.8735C22.6032 19.8427 22.6773 20.6334 22.8502 21.22C23.0231 21.8321 23.3196 22.3423 23.7644 22.7759C24.1843 23.2349 24.6785 23.541 25.2715 23.7195C25.8645 23.9237 26.6059 24.0002 27.5447 24.0002H37.4278C38.3421 24.0002 39.0833 23.9237 39.6763 23.7195C40.2693 23.541 40.7634 23.2349 41.2082 22.7759C41.6281 22.3423 41.9247 21.8321 42.0976 21.22C42.2705 20.6334 42.3695 19.8427 42.3695 18.8735V6.98779H38.2431V18.9755C38.2431 19.4856 38.1196 19.8172 37.922 19.9957C37.7244 20.1742 37.329 20.2509 36.7607 20.2509H28.2118C27.6188 20.2509 27.2235 20.1742 27.0258 19.9957C26.8282 19.8172 26.7294 19.4856 26.7294 18.9755ZM56.3274 24.0002V10.7372H64.3081V6.98796H44.2205V10.7371H52.2012V24.0002H56.3274ZM70.284 18.9755V6.98779H66.1578V18.8735C66.1578 19.8427 66.2319 20.6334 66.405 21.22C66.5779 21.8321 66.8743 22.3423 67.3191 22.7759C67.7392 23.2349 68.2334 23.541 68.8264 23.7195C69.4194 23.9237 70.1605 24.0002 71.0995 24.0002H80.9827C81.8968 24.0002 82.638 23.9237 83.231 23.7195C83.824 23.541 84.3181 23.2349 84.7629 22.7759C85.183 22.3423 85.4794 21.8321 85.6525 21.22C85.8254 20.6334 85.9242 19.8427 85.9242 18.8735V6.98779H81.798V18.9755C81.798 19.4856 81.6745 19.8172 81.4767 19.9957C81.2791 20.1742 80.8837 20.2509 80.3154 20.2509H71.7666C71.1736 20.2509 70.7782 20.1742 70.5806 19.9957C70.3829 19.8172 70.284 19.4856 70.284 18.9755ZM106.835 11.936V11.6044C106.835 10.0231 106.44 8.84985 105.649 8.11023C104.859 7.37044 103.598 6.98796 101.918 6.98796H87.9089V24.0002H102.734C104.414 24.0002 105.674 23.643 106.465 22.9034C107.255 22.1638 107.651 20.9905 107.651 19.4091V19.0521C107.651 17.4707 107.255 16.3484 106.465 15.6853C106.316 15.5833 106.168 15.5068 106.02 15.4303C105.811 15.3246 105.596 15.2309 105.377 15.1497C105.921 14.8437 106.291 14.4355 106.514 13.9764C106.712 13.5174 106.835 12.8286 106.835 11.936ZM92.0351 13.7979V10.7372H101.251C101.844 10.7372 102.239 10.8392 102.437 11.0177C102.635 11.1962 102.734 11.5279 102.734 12.0125V12.5225C102.734 13.0328 102.635 13.3643 102.437 13.5428C102.239 13.7214 101.844 13.7977 101.251 13.7977L92.0351 13.7979ZM92.0351 20.2509V17.1901H102.091C102.659 17.1901 103.055 17.2922 103.252 17.4707C103.45 17.6492 103.574 17.9808 103.574 18.4655V18.9755C103.574 19.4856 103.45 19.8172 103.252 19.9957C103.055 20.1742 102.659 20.2509 102.091 20.2509H92.0351ZM113.247 10.7372H126.738V6.98796H109.121V24.0002H127.405V20.2509H113.247V17.3687H126.417L126.738 13.6194H113.247V10.7372Z" fill="#5D5564" />
                                    <path d="M132.297 5.96076C133.892 5.96076 135.184 4.6264 135.184 2.98038C135.184 1.33436 133.892 0 132.297 0C130.703 0 129.41 1.33436 129.41 2.98038C129.41 4.6264 130.703 5.96076 132.297 5.96076Z" fill="#5D5564" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if( $site_contacts_footer_logos ): ?>
                    <div class="footer__partners">
                        <?php $counter = 1; foreach( $site_contacts_footer_logos as $site_contacts_footer_logo ): ?>
                            <div class="footer__partners-item">
                                <?= get_retina_img($site_contacts_footer_logo, 'Partner Logo - ' . $counter); ?>
                            </div>
                        <?php $counter++; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if( $site_contacts_copy ): ?>
                <div class="footer__copy"><?= str_replace('{{year}}', date('Y'), $site_contacts_copy); ?></div>
            <?php endif; ?>
        </div>
    </footer>

    <div class="main-popup" id="demo-vm">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__left">
                <div class="main-popup__img">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/main-popup-img-1.png" alt="SpaceVM">
                    <div class="main-popup__sub">Заявка на&nbsp;демоверсию SpaceVM</div>
                </div>
            </div>
            <div class="main-popup__right">
                <form class="main-popup__form main-popup__form--aqua ajax-wrap js-form">
                    <div class="main-popup__form-title">Заполните информацию ниже и&nbsp;мы свяжемся с&nbsp;вами</div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php if( $form_partner_options ): ?>
                            <div class="main-popup__form-col main-popup__form-col--lg">
                                <div class="main-select main-select--aqua">
                                    <select class="js-select js-feedback-input js-partner-select" name="partner"><?= $form_partner_options; ?></select>
                                    <span class="js-select-toggle">Выберите партнера</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="name">
                                    <span>Имя и фамилия</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="company">
                                    <span>Организация</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                    <span>Номер телефона</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="email">
                                    <span>E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                    <span>Комментарий</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на демо-версию SpaceVM">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="main-popup" id="buy-vm">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            // <div class="main-popup__left">
                // <div class="main-popup__img">
                    // <img src="<?= get_template_directory_uri(); ?>/assets/img/main-popup-img-1.png" alt="SpaceVM">
                    // <div class="main-popup__sub">Заявка <br>на покупку <br>SpaceVM</div>
                // </div>
            // </div>
            <div class="main-popup__right">
                <form class="main-popup__form main-popup__form--aqua ajax-wrap js-form">
                    <div class="main-popup__form-title">Заполните информацию ниже и&nbsp;мы свяжемся с&nbsp;вами</div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php if( $form_partner_options ): ?>
                            <div class="main-popup__form-col main-popup__form-col--lg">
                                <div class="main-select main-select--aqua">
                                    <select class="js-select js-feedback-input js-partner-select" name="partner"><?= $form_partner_options; ?></select>
                                    <span class="js-select-toggle">Выберите партнера</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="name">
                                    <span>Имя и фамилия</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="company">
                                    <span>Организация</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                    <span>Номер телефона</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="email">
                                    <span>E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-input main-input--aqua">
                                <label>
                                    <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                    <span>Комментарий</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на покупку SpaceVM">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="main-popup" id="demo-vdi">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__left">
                <div class="main-popup__img">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/main-popup-img-2.png" alt="SpaceVDI">
                    <div class="main-popup__sub">Заявка на&nbsp;демоверсию Space VDI</div>
                </div>
            </div>
            <div class="main-popup__right">
                <form class="main-popup__form ajax-wrap js-form">
                    <div class="main-popup__form-title">Заполните информацию ниже и&nbsp;мы свяжемся с&nbsp;вами</div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php if( $form_partner_options ): ?>
                            <div class="main-popup__form-col main-popup__form-col--lg">
                                <div class="main-select">
                                    <select class="js-select js-feedback-input js-partner-select" name="partner"><?= $form_partner_options; ?></select>
                                    <span class="js-select-toggle">Выберите партнера</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="name">
                                    <span>Имя и фамилия</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="company">
                                    <span>Организация</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                    <span>Номер телефона</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="email">
                                    <span>E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-input">
                                <label>
                                    <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                    <span>Комментарий</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на демо-версию Space VDI">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="main-popup" id="buy-vdi">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            // <div class="main-popup__left">
                // <div class="main-popup__img">
                    // <img src="<?= get_template_directory_uri(); ?>/assets/img/main-popup-img-2.png" alt="SpaceVDI">
                    // <div class="main-popup__sub">Заявка <br>на покупку <br>Space VDI</div>
                // </div>
            // </div>
            <div class="main-popup__right">
                <form class="main-popup__form ajax-wrap js-form">
                    <div class="main-popup__form-title">Заполните информацию ниже и&nbsp;мы свяжемся с&nbsp;вами</div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php if( $form_partner_options ): ?>
                            <div class="main-popup__form-col main-popup__form-col--lg">
                                <div class="main-select">
                                    <select class="js-select js-feedback-input js-partner-select" name="partner"><?= $form_partner_options; ?></select>
                                    <span class="js-select-toggle">Выберите партнера</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="name">
                                    <span>Имя и фамилия</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="company">
                                    <span>Организация</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                    <span>Номер телефона</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="email">
                                    <span>E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-input">
                                <label>
                                    <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                    <span>Комментарий</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на покупку Space VDI">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="main-popup" id="partner-popup">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__left">
                <div class="main-popup__img">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/main-popup-img-3.png" alt="Space">
                    <div class="main-popup__sub">Станьте <br>партнером — <br>Space</div>
                </div>
            </div>
            <div class="main-popup__right">
                <form class="main-popup__form ajax-wrap js-form">
                    <div class="main-popup__form-title">Заполните информацию ниже и&nbsp;мы свяжемся с&nbsp;вами</div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="name">
                                    <span>Имя и фамилия</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="company">
                                    <span>Организация</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                    <span>Номер телефона</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="email">
                                    <span>E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-input">
                                <label>
                                    <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                    <span>Комментарий</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на партнера">
                    <input type="hidden" name="to" value="<?= $site_feedback_partner_email; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="main-popup main-popup--simple" id="demo-popup">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__right">
                <form class="main-popup__form ajax-wrap js-form">
                    <div class="main-popup__form-title">Оставить на&nbsp;сайте <br>заявку&nbsp;на демо-версию</div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php if( $form_product_options ): ?>
                            <div class="main-popup__form-col">
                                <div class="main-select">
                                    <select class="js-select js-feedback-input" name="product"><?= $form_product_options; ?></select>
                                    <span class="js-select-toggle">Выберите продукт</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if( $form_partner_options ): ?>
                            <div class="main-popup__form-col">
                                <div class="main-select">
                                    <select class="js-select js-feedback-input js-partner-select" name="partner"><?= $form_partner_options; ?></select>
                                    <span class="js-select-toggle">Выберите партнёра</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="name">
                                    <span>Имя и фамилия</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="company">
                                    <span>Организация</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                    <span>Номер телефона</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col">
                            <div class="main-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="email">
                                    <span>E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-input">
                                <label>
                                    <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                    <span>Комментарий</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на демо-версию">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="main-popup main-popup--result" id="feedback-success">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__right">
                <form class="main-popup__form">
                    <div class="main-popup__form-title">Заявка успешно отправлена!</div>
                    <div class="main-popup__form-desc">Скоро с вами свяжется наш менеджер</div>
                    <div class="main-popup__form-btn">
                        <button class="btn btn-white" type="button" data-fancybox-close>Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main-popup main-popup--result" id="feedback-error">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__right">
                <form class="main-popup__form">
                    <div class="main-popup__form-title">Произошла ошибка!</div>
                    <div class="main-popup__form-desc">При отправке произошла ошибка. <br>Попробуйте обновить страницу и&nbsp;отправить заявку заново</div>
                    <div class="main-popup__form-btn">
                        <button class="btn btn-white" type="button" data-fancybox-close>Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>

</html>