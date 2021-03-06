<?php namespace Anomaly\UsersModule\User\Password;

use Anomaly\Streams\Platform\Ui\Form\FormCriteria;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;

/**
 * Class ResetPasswordFormCriteria
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\UsersModule\User\Password
 */
class ResetPasswordFormCriteria extends FormCriteria
{

    /**
     * Fired just before building.
     *
     * @param Encrypter $encrypter
     * @param Request   $request
     */
    public function onReady(Encrypter $encrypter, Request $request)
    {
        array_set($this->parameters, 'code', $encrypter->decrypt($request->get('code')));
        array_set($this->parameters, 'email', $encrypter->decrypt($request->get('email')));
    }
}
