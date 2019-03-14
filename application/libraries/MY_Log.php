<?php

/**
 * Created by PhpStorm.
 * User: huuhien
 * Date: 9/13/16
 * Time: 2:37 PM
 */
class MY_Log extends CI_Log
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $config = & get_config();

        $this->_log_path = ($config['log_path'] != '') ? $config['log_path'] : APPPATH . 'logs/';

        if (! is_dir($this->_log_path) or ! is_really_writable($this->_log_path)) {
            $this->_enabled = FALSE;
        }

        if (is_numeric($config['log_threshold'])) {
            $this->_threshold = $config['log_threshold'];
        }

        if ($config['log_date_format'] != '') {
            $this->_date_fmt = $config['log_date_format'];
        }
    }

    private function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }

    // --------------------------------------------------------------------
    /**
     * Write Log File
     *
     * Generally this function will be called using the global log_message() function
     *
     * @access public
     * @param
     *            string the error level
     * @param
     *            string the error message
     * @param
     *            bool whether the error is a native PHP error
     * @return bool
     */
    public function write_log($level = 'error', $msg, $php_error = FALSE)
    {
        if ($this->_enabled === FALSE) {
            return FALSE;
        }

        $level = strtoupper($level);

        if (! isset($this->_levels[$level]) or ($this->_levels[$level] > $this->_threshold)) {
            return FALSE;
        }

        if ($this->_levels[$level] == 2) {
            return FALSE;
        }

        if (strtolower($level) == 'error') {
            if (strpos($msg, '[Invoice]') !== false) {
                $filepath = $this->_log_path . 'log-error-invoice-' . date('Y-m-d') . '.txt';
            } else if (strpos($msg, '[Extraction]') !== false) {
                $filepath = $this->_log_path . 'log-error-extraction-' . date('Y-m-d') . '.txt';
            } else if (strpos($msg, '[Importer]') !== false) {
                $filepath = $this->_log_path . 'log-error-importer-' . date('Y-m-d') . '.txt';
            } else {
                $filepath = $this->_log_path . 'log-error-' . date('Y-m-d') . '.txt';
            }
        } else {
            $filepath = $this->_log_path . 'log-' . date('Y-m-d') . '.txt';
        }

        $message = '';

        if (! $fp = @fopen($filepath, FOPEN_WRITE_CREATE)) {
            return FALSE;
        }

        if ($this->isCommandLineInterface()) {
            $message .= 'CMD ';
        }

        $message .= $level . ' ' . (($level == 'INFO') ? ' -' : '-') . ' ' . date($this->_date_fmt) . ' --> ' . $msg . "\n";

        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($filepath, FILE_WRITE_MODE);
        return TRUE;
    }
}