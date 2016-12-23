<?php

namespace Brood\Services;

use Illuminate\Validation\Validator as IlluminateValidator;

class ValidationExtender extends IlluminateValidator 
{

    private $_custom_messages = array(
        "alpha_dash_spaces" => ":attribute mag alleen letters en spacies bevatten.",
        "alpha_num_spaces" => ":attribute mag alleen letters, nummers en spacies bevatten.",
        "alpha_num_spaces_spec_char" =>":attribute mag alleen letters, nummers, spacies, punten, komma's, vraag- en uitroeptekens bevatten.",
    );


    public function __construct($translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes );
    
        $this->_set_custom();
    }

    /**
     * Setup any customizations etc
     *
     * @return void
     */
    protected function _set_custom() {
        //setup our custom error messages
        $this->setCustomMessages( $this->_custom_messages );
    }

    /**
     * Allow only alphabets, spaces and dashes (hyphens and underscores)
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    protected function validateAlphaDashSpaces( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Za-z\s-_]+$/", $value );
    }

    /**
     * Allow only alphabets, numbers, and spaces
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    protected function validateAlphaNumSpaces( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Za-z0-9\s]+$/", $value );
    }

    /**
     * Allow only alphabets, numbers, spaces and special characters (.,?!) 
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    protected function validateAlphaNumSpacesSpecChar( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Za-z0-9\s.,!?()]+$/", $value );
    }
}