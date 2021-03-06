<?php

namespace Axllent\EnquiryPage\Forms;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Session;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\TextField;

class CaptchaField extends TextField
{
    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = [];

        $attributes['type'] = 'number';
        $attributes['autocomplete'] = 'off';
        $attributes['required'] = 'required';

        return array_merge(
            parent::getAttributes(),
            $attributes
        );
    }

    public function validationImageURL()
    {
        return $this->getForm()->getController()->Link() .'captcha.jpg?' . time();
    }

    /*
     * SERVER-SIDE VALIDATION (to ensure a browser with javascript disabled doesn't bypass validation)
     */
    public function validate($validator)
    {
        $this->value = trim($this->value);
        $request = Controller::curr()->getRequest();
        $session_captcha = $request->getSession()->get('customcaptcha');

        if (md5(trim($this->value) . $_SERVER['REMOTE_ADDR']) .
            Config::inst()->get('Axllent\EnquiryPage\EnquiryPage', 'random_string') != $session_captcha
        ) {
            $validator->validationError(
                $this->name,
                'Codes do not match, please try again',
                'required'
            );
            $this->value = '';
        }
    }
}
