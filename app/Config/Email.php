<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $fromEmail   = 'manhvt89@gmail.com';
    public $fromName    = 'Vu Thanh Manh';
    public string $recipients = '';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     */
    public $protocol    = 'smtp';

    /**
     * The server path to Sendmail.
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Hostname
     */
    public $SMTPHost    = 'smtp.gmail.com';

    /**
     * SMTP Username
     */
    public $SMTPUser    = 'manhvt89@gmail.com';

    /**
     * SMTP Password
     */
    public $SMTPPass    = '';

    /**
     * SMTP Port
     */
    public $SMTPPort    = 25;

    /**
     * SMTP Timeout (in seconds)
     */
    public int $SMTPTimeout = 5;

    /**
     * Enable persistent SMTP connections
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption.
     *
     * @var string '', 'tls' or 'ssl'. 'tls' will issue a STARTTLS command
     *             to the server. 'ssl' means implicit SSL. Connection on port
     *             465 should set this to ''.
     */
    public $SMTPCrypto  = 'tsl';

    /**
     * Enable word-wrap
     */
    public bool $wordWrap = true;

    /**
     * Character count to wrap at
     */
    public int $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     */
    public $mailType    = 'html';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public $charset     = 'utf-8';

    /**
     * Whether to validate the email address
     */
    public bool $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     */
    public bool $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     */
    public int $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     */
    public bool $DSN = false;

    public function __construct()
    {
        parent::__construct();
        /*
        $this->protocol = env('app.email.protocol');
        $this->SMTPHost = env('smtp.gmail.com');
        $this->SMTPPort = env('app.email.SMTPPort');
        $this->SMTPCrypto = env('app.email.SMTPCrypto');
        $this->SMTPUser   = env('app.email.SMTPUser');
        $this->SMTPPass   = env('app.email.SMTPPass');
        $this->fromEmail  = env('app.email.fromEmail');
        $this->fromName   = env('app.email.fromName');
        */
        $this->protocol = 'smtp';
        $this->SMTPHost = 'smtp.gmail.com';
        $this->SMTPPort = 587;
        $this->SMTPCrypto = 'tls';
        $this->SMTPUser   = 'manhvt89@gmail.com';
        $this->SMTPPass   = 'mwliuiescmgqsyfo';
        $this->fromEmail  = 'manhvt89@gmail.com';
        $this->fromName   = 'my App';

    }
}
