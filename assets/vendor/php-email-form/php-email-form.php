<?php

class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $messages = [];
    public $ajax = false;
    public $smtp = [];

    public function add_message($message, $key, $length = 0) {
        $this->messages[$key] = $message;
    }

    public function send() {
        // Use SMTP if configured
        if (!empty($this->smtp)) {
            // SMTP configuration and sending logic goes here
            // You can use PHPMailer or another library for SMTP support
        } else {
            // Use PHP's mail function
            return $this->send_mail();
        }
    }

    private function send_mail() {
        $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
        $headers .= "Reply-To: " . $this->from_email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $message = "";
        foreach ($this->messages as $key => $value) {
            $message .= ucfirst($key) . ": " . $value . "\n";
        }

        return mail($this->to, $this->subject, $message, $headers);
    }
}

?>