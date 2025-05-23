<?php
/**
 * Process contact form submission via AJAX
 */
function real_estate_process_contact_form() {
    // Verify nonce
    if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_nonce')) {
        wp_send_json_error('Security verification failed');
        wp_die();
    }

    // Sanitize form data
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $inquiry_type = isset($_POST['inquiry_type']) ? sanitize_text_field($_POST['inquiry_type']) : '';
    $hear_about = isset($_POST['hear_about']) ? sanitize_text_field($_POST['hear_about']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    
    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields');
        wp_die();
    }

    // Get admin email
    $admin_email = get_option('admin_email');
    
    // Set up email content
    $subject = 'New Contact Form Submission from ' . $first_name . ' ' . $last_name;
    
    $body = "You have received a new contact form submission:\n\n";
    $body .= "First Name: " . $first_name . "\n";
    $body .= "Last Name: " . $last_name . "\n";
    $body .= "Email: " . $email . "\n";
    
    if (!empty($phone)) {
        $body .= "Phone: " . $phone . "\n";
    }
    
    if (!empty($inquiry_type)) {
        $body .= "Inquiry Type: " . $inquiry_type . "\n";
    }
    
    if (!empty($hear_about)) {
        $body .= "How they heard about us: " . $hear_about . "\n";
    }
    
    $body .= "Message: " . $message . "\n";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    // Send email
    $mail_sent = wp_mail($admin_email, $subject, $body, $headers);
    
    if ($mail_sent) {
        // Optional: Save to database or take other actions
        
        wp_send_json_success('Message sent successfully');
    } else {
        wp_send_json_error('Failed to send message');
    }
    
    wp_die();
}
add_action('wp_ajax_process_contact_form', 'real_estate_process_contact_form');
add_action('wp_ajax_nopriv_process_contact_form', 'real_estate_process_contact_form');