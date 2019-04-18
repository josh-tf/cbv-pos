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
        $this->CI = &get_instance(); // hook in to CI
        $this->CI->load->library('email'); // load the CI Email Library
    }

    public function sendEmail($to, $subject, $message, $attachment = null)
    {

        $proto = $this->CI->config->item('smtp_crypto');
        $hoststr = ($proto == 'SSL' ? 'ssl://' : 'tls://'); // change connection str depending on crypto selection

        $config = array(
            'protocol' => $this->CI->config->item('protocol'),
            'smtp_host' => $hoststr . $this->CI->config->item('smtp_host'),
            'smtp_port' => $this->CI->config->item('smtp_port'),
            'smtp_user' => $this->CI->config->item('smtp_user'),
            'smtp_pass' => $this->CI->encryption->decrypt($this->CI->config->item('smtp_pass')),
            'smtp_timeout' => $this->CI->config->item('smtp_timeout'),
            'mailpath' => $this->CI->config->item('mailpath'),
            'mailtype' => 'html',
            'useragent' => 'CBVPOS',
            'charset' => 'utf-8',
            'wordwrap' => true,

        );
        $email = $this->CI->email;
        $email->set_newline("\r\n");
        $email->initialize($config);

        // grab company name and email address from the general config
        $email->from($this->CI->config->item('email'), $this->CI->config->item('company'));

        // set our email options
        $email->to($to);
        $email->subject($subject);
		$email->message($message);

		// attach file if applicable
		if($attachment){$email->attach($attachment);}

        // send the email
        $result = $email->send();

        if (!$result) {
            error_log($email->print_debugger()); // log on error
        }

        return $result;
    }
}
