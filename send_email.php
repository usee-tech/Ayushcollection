<?php
// Set the recipient email address
$to = "aishaumarisah696@gmail.com";

// Get form data
$form_type = $_POST['form_type'];

if ($form_type == "contact") {
    // Contact form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
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
    ";
    
    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    
} elseif ($form_type == "product_message") {
    // Product message form data
    $name = $_POST['messageName'];
    $phone = $_POST['messagePhone'];
    $product_title = $_POST['product_title'];
    $message = $_POST['messageText'];
    
    // Email subject
    $email_subject = "Ayush Collection Product Inquiry: $product_title";
    
    // Email body
    $email_body = "
    New product inquiry from Ayush Collection website:
    
    Customer Name: $name
    Phone: $phone
    Product: $product_title
    
    Message:
    $message
    ";
    
    // Email headers
    $headers = "From: Ayush Collection Website <noreply@ayushcollection.com>\r\n";
    $headers .= "Reply-To: $phone@ayushcollection.com\r\n";
}

// Send email
if (mail($to, $email_subject, $email_body, $headers)) {
    // Email sent successfully
    if ($form_type == "contact") {
        header("Location: index.html?success=contact");
    } elseif ($form_type == "product_message") {
        header("Location: index.html?success=message");
    }
} else {
    // Email failed to send
    if ($form_type == "contact") {
        header("Location: index.html?error=contact");
    } elseif ($form_type == "product_message") {
        header("Location: index.html?error=message");
    }
}

exit;
?>