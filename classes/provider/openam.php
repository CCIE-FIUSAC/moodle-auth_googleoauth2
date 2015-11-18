<?php

require_once($CFG->dirroot . '/auth/googleoauth2/vendor/autoload.php');

class provideroauth2openam extends League\OAuth2\Client\Provider\OpenAM {

    // THE VALUES YOU WANT TO CHANGE WHEN CREATING A NEW PROVIDER.
    public $sskstyle = 'openam';
    public $name = 'openam'; // It must be the same as the XXXXX in the class name provideroauth2XXXXX.
    public $readablename = 'Iniciar sesión';
    public $statesalt = '';

    /**
     * Constructor.
     *
     * @throws Exception
     * @throws dml_exception
     */
    public function __construct() {
        global $CFG;

        parent::__construct([
            'clientId'      => get_config('auth/googleoauth2', $this->name . 'clientid'),
            'clientSecret'  => get_config('auth/googleoauth2', $this->name . 'clientsecret'),
            'redirectUri'   => $CFG->wwwroot .'/auth/googleoauth2/' . $this->name . '_redirect.php',
            'scopes'        => get_config('auth/googleoauth2', $this->name . 'scope'), // not an array of scopes
            'domain'        => get_config('auth/googleoauth2', $this->name . 'serverurl'),
            'responseType'  => get_config('auth/googleoauth2', $this->name . 'responsetype'),
        ]);
        $this->statesalt = get_config('auth/googleoauth2', 'openamstatesalt');
    }

    /**
     * Is the provider enabled.
     *
     * @return bool
     * @throws Exception
     * @throws dml_exception
     */
    public function isenabled() {
        return (get_config('auth/googleoauth2', $this->name . 'clientid')
            && get_config('auth/googleoauth2', $this->name . 'clientsecret'));
    }

    /**
     * The html button.
     *
     * @param $authurl
     * @param $providerdisplaystyle
     * @return string
     * @throws coding_exception
     */
    public function html_button($authurl, $providerdisplaystyle) {
        return googleoauth2_html_button($authurl, $providerdisplaystyle, $this);
    }
}
