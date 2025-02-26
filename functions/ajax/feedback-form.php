<?php

if( !defined('ABSPATH') ){
    exit;
}

add_action('wp_ajax_nopriv_feedback_form', 'ajax_feedback_form');
add_action('wp_ajax_feedback_form', 'ajax_feedback_form');

function ajax_feedback_form(){
    $result = ['status' => false];

    if( isset($_POST['product']) ){
        $product = sanitize_text_field($_POST['product']);
    }else{
        $product = false;
    }

    if( isset($_POST['partner']) ){
        $partner = sanitize_text_field($_POST['partner']);
    }else{
        $partner = false;
    }

    if( isset($_POST['name']) ){
        $name = sanitize_text_field($_POST['name']);
    }else{
        $name = false;
    }

    if( isset($_POST['specialization']) ){
        $specialization = sanitize_text_field($_POST['specialization']);
    }else{
        $specialization = false;
    }

    if( isset($_POST['company']) ){
        $company = sanitize_text_field($_POST['company']);
    }else{
        $company = false;
    }

    if( isset($_POST['phone']) ){
        $phone = sanitize_text_field($_POST['phone']);
    }else{
        $phone = false;
    }

    if( isset($_POST['email']) ){
        $email = sanitize_text_field($_POST['email']);
    }else{
        $email = false;
    }
    
    if( isset($_POST['production']) ){
        $production = sanitize_text_field($_POST['production']);
    }else{
        $production = false;
    }

    if( isset($_POST['msg']) ){
        $msg = sanitize_textarea_field($_POST['msg']);
    }else{
        $msg = false;
    }

    if( isset($_POST['form_name']) ){
        $form_name = sanitize_text_field($_POST['form_name']);
    }else{
        $form_name = 'Заявка';
    }

    if( isset($_POST['to']) ){
        $to = sanitize_text_field($_POST['to']);
    }else{
        $to = get_option('admin_email');
    }

    if( isset($_POST['url']) ){
        $url = sanitize_text_field($_POST['url']);
    }else{
        $url = false;
    }

    if( isset($_FILES['file']) && !empty($_FILES['file']['name']) ){
        add_filter('upload_dir', 'custom_upload_directory');

        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if( $movefile && !isset($movefile['error']) ){
            $file_url = $movefile['url'];
        }else{
            $file_url = '';
        }

        remove_filter('upload_dir', 'custom_upload_directory');
    }else{
        $file_url = '';
    }
    
    $to = explode(',', $to);
    $to = array_map('trim', $to);
    $subject = $form_name . ' с сайта Space';
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . 'Space' . ' <info@spacevm.ru>');

    $message = '<p style="font-size: 22px; text-align: center; padding-bottom: 30px; margin: 0;"><b>Детали заявки:</b></p><table>';
    
    if( $product ){
        $message .= '<tr>
            <td><b>Продукт</b></td>
            <td>' . $product . '</td>
        </tr>';
    }
    if( $partner ){
        $message .= '<tr>
            <td><b>Партнер</b></td>
            <td>' . $partner . '</td>
        </tr>';
    }
    if( $name ){
        $message .= '<tr>
            <td><b>Имя</b></td>
            <td>' . $name . '</td>
        </tr>';
    }
    if( $specialization ){
        $message .= '<tr>
            <td><b>Специализация</b></td>
            <td>' . $specialization . '</td>
        </tr>';
    }
    if( $company ){
        $message .= '<tr>
            <td><b>Организация</b></td>
            <td>' . $company . '</td>
        </tr>';
    }
    if( $phone ){
        $message .= '<tr>
            <td><b>Номер телефона</b></td>
            <td><a href="tel:' . str_replace(array(' ', '-', '(', ')'), '', $phone) . '">' . $phone . '</a></td>
        </tr>';
    }
    if( $email ){
        $message .= '<tr>
            <td><b>E-mail</b></td>
            <td><a href="mailto:' . $email . '">' . $email . '</a></td>
        </tr>';
    }
    if( $production ){
        $message .= '<tr>
            <td><b>Выпускаемая продукция</b></td>
            <td>' . $production . '</td>
        </tr>';
    }
    if( $file_url ){
        $message .= '<tr>
            <td><b>Резюме</b></td>
            <td><a href="' . $file_url . '" target="_blank">' . $file_url . '</a></td>
        </tr>';
    }
    if( $msg ){
        $message .= '<tr>
            <td><b>Комментарий</b></td>
            <td>' . $msg . '</td>
        </tr>';
    }
    if( $form_name ){
        $message .= '<tr>
            <td><b>Название формы</b></td>
            <td>' . $form_name . '</td>
        </tr>';
    }
    if( $url ){
        $message .= '<tr>
            <td><b>Страница отправки</b></td>
            <td><a href="' . $url . '" target="_blank">' . $url . '</a></td>
        </tr>';
    }
    
    $message .= '</table>';

    $post_title = $form_name;

    if( $product ){
        $post_title .= ' ' . $product;
    }
    if( $partner ){
        $post_title .= ' | ' . $partner;
    }
    if( $name && $phone ){
        $post_title .= ' - ' . $name . ' ' . $phone;
    }

    $post_data = array(
        'post_title'    => $post_title,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'mail',
        'post_content'  => $message,
    );
    
    $messageMail = $message . '
    <style>
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table tr td{
            border: 1px solid #000;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>';

    $mail = wp_mail($to, $subject, $messageMail, $headers);

    if( $mail && wp_insert_post( $post_data ) ){
        $result['status'] = true;
    }

    echo json_encode($result);

    die();
}