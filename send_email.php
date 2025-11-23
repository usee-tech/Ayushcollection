<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form type
    $form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';
    
    // Set the recipient email address
    $to = "uibrahim6202@gmail.com";
    
    $response = ['status' => 'error', 'message' => 'Unknown error occurred'];
    
    if ($form_type == "contact") {
        // Contact form data
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        
        // Validate required fields
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            $response = ['status' => 'error', 'message' => 'All fields are required'];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = ['status' => 'error', 'message' => 'Invalid email address'];
        } else {
            // Email subject
            $email_subject = "Ayush Collection Contact: $subject";
            
            // Email body
            $email_body = "
            New contact form submission from Ayush Collection website:
            
            Name: $name
            Email: $email
            Subject: $subject
            
            Message:
            $message
            
            ---
            Sent from Ayush Collection Website
            ";
            
            // Email headers
            $headers = "From: Ayush Collection <noreply@ayushcollections.com>\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            // Send email
            if (mail($to, $email_subject, $email_body, $headers)) {
                $response = ['status' => 'success', 'message' => 'Message sent successfully!'];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to send email. Please try again.'];
            }
        }
        
    } elseif ($form_type == "product_message") {
        // Product message form data
        $name = isset($_POST['messageName']) ? trim($_POST['messageName']) : '';
        $phone = isset($_POST['messagePhone']) ? trim($_POST['messagePhone']) : '';
        $product_title = isset($_POST['product_title']) ? trim($_POST['product_title']) : '';
        $message_text = isset($_POST['messageText']) ? trim($_POST['messageText']) : '';
        
        // Validate required fields
        if (empty($name) || empty($phone) || empty($product_title) || empty($message_text)) {
            $response = ['status' => 'error', 'message' => 'All fields are required'];
        } else {
            // Email subject
            $email_subject = "Ayush Collection Product Inquiry: $product_title";
            
            // Email body
            $email_body = "
            New product inquiry from Ayush Collection website:
            
            Customer Name: $name
            Phone: $phone
            Product: $product_title
            
            Message:
            $message_text
            
            ---
            Sent from Ayush Collection Website
            ";
            
            // Email headers
            $headers = "From: Ayush Collection <noreply@ayushcollections.com>\r\n";
            $headers .= "Reply-To: noreply@ayushcollections.com\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            // Send email
            if (mail($to, $email_subject, $email_body, $headers)) {
                $response = ['status' => 'success', 'message' => 'Message sent successfully!'];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to send email. Please try again.'];
            }
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid form type'];
    }
    
    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
