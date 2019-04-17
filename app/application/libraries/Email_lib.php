<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Email library
 *
 * Library with utilities to configure and send emails
 */

class Email_lib
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->library('email');

        $config = array(
            'mailtype' => 'html',
            'useragent' => 'OSPOS',
            'validate' => true,
            'protocol' => $this->CI->config->item('protocol'),
            'mailpath' => $this->CI->config->item('mailpath'),
            'smtp_host' => $this->CI->config->item('smtp_host'),
            'smtp_user' => $this->CI->config->item('smtp_user'),
            'smtp_pass' => $this->CI->encryption->decrypt($this->CI->config->item('smtp_pass')),
            'smtp_port' => $this->CI->config->item('smtp_port'),
            'smtp_timeout' => $this->CI->config->item('smtp_timeout'),
            'smtp_crypto' => $this->CI->config->item('smtp_crypto'),
        );

        $this->CI->email->initialize($config);
    }

    /**
     * Email sending function
     * Example of use: $response = sendEmail('john@doe.com', 'Hello', 'This is a message', $filename);
     */
    public function sendEmail($to, $subject, $message, $attachment = null)
    {
        require 'class.smtp.php';
        require 'class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->SMTPAuth = true;
        $mail->Host = $this->CI->config->item('smtp_host');
		$mail->Port = $this->CI->config->item('smtp_port');
		$mail->SMTPSecure = $this->CI->config->item('smtp_crypto');
        $mail->addAddress($to);
        if (!empty($attachment)) {
            $mail->addStringAttachment($attachment);
        }
        $mail->Username = $this->CI->config->item('smtp_user');
        $mail->Password = $this->CI->encryption->decrypt($this->CI->config->item('smtp_pass'));
        $mail->setFrom($this->CI->config->item('smtp_user'), $this->config->item('company'));
        $mail->addReplyTo($this->CI->config->item('smtp_user'), $this->config->item('company'));
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->send();
        $result = $mail->send();
        if (!$result) {
            error_log($email->print_debugger());
        }
        return $result;

    }
}
