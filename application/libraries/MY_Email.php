<?php

/**
 * Created by PhpStorm.
 * User: huuhien
 * Date: 9/19/16
 * Time: 10:19 AM
 */
class MY_Email extends CI_Email
{

    /**
     * Send Email
     *
     * @access public
     * @return bool
     */
    public function send()
    {
        if ((! isset($this->_recipients) and ! isset($this->_headers['To'])) and (! isset($this->_bcc_array) and ! isset($this->_headers['Bcc'])) and (! isset($this->_headers['Cc']))) {
            $this->_set_error_message('lang:email_no_recipients');
            return FALSE;
        }

        $this->_build_headers();

        if ($this->bcc_batch_mode and count($this->_bcc_array) > 0) {
            if (count($this->_bcc_array) > $this->bcc_batch_size)
                return $this->batch_bcc_send();
        }

        $this->_build_message();

        if (! $this->_spool_email()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}