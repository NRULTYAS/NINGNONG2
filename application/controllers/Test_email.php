<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('url');
    }

    public function index() {
        echo "<h2>Test Email SMTP</h2>";

        // Load config
        $this->config->load('email', TRUE);
        $email_config = [
            'protocol'    => $this->config->item('protocol', 'email'),
            'smtp_host'   => $this->config->item('smtp_host', 'email'),
            'smtp_port'   => $this->config->item('smtp_port', 'email'),
            'smtp_user'   => $this->config->item('smtp_user', 'email'),
            'smtp_pass'   => $this->config->item('smtp_pass', 'email'),
            'smtp_crypto' => $this->config->item('smtp_crypto', 'email'),
            'mailtype'    => $this->config->item('mailtype', 'email'),
            'charset'     => $this->config->item('charset', 'email'),
            'newline'     => $this->config->item('newline', 'email'),
        ];

        echo "<pre>";
        echo "Config yang dipakai:\n";
        echo "smtp_user: " . $email_config['smtp_user'] . "\n";
        echo "smtp_pass: " . substr($email_config['smtp_pass'], 0, 4) . "****\n";
        echo "smtp_host: " . $email_config['smtp_host'] . "\n";
        echo "smtp_port: " . $email_config['smtp_port'] . "\n";
        echo "</pre>";

        // Re-init library
        $this->load->library('email', $email_config);

        $this->email->from($email_config['smtp_user'], 'Test NINGNONG');
        $this->email->to($email_config['smtp_user']); // kirim ke diri sendiri
        $this->email->subject('Test Email dari NINGNONG');
        $this->email->message('<p>Ini test email dari sistem NINGNONG.</p>');

        if ($this->email->send()) {
            echo "<p style='color:green; font-weight:bold;'>✅ Email BERHASIL dikirim!</p>";
        } else {
            echo "<p style='color:red; font-weight:bold;'>❌ Email GAGAL dikirim.</p>";
            echo "<h3>Debug Info:</h3>";
            echo "<pre style='background:#f5f5f5; padding:15px; border:1px solid #ddd; overflow:auto; max-height:500px;'>";
            echo htmlspecialchars($this->email->print_debugger());
            echo "</pre>";
        }
    }
}