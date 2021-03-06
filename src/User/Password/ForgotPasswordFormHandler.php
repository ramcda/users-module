<?php namespace Anomaly\UsersModule\User\Password;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ForgotPasswordFormHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\UsersModule\User\Password
 */
class ForgotPasswordFormHandler
{

    /**
     * Handle the form.
     *
     * @param ForgotPasswordFormBuilder $builder
     * @param UserRepositoryInterface   $users
     * @param UserPassword              $password
     */
    public function handle(
        ForgotPasswordFormBuilder $builder,
        UserRepositoryInterface $users,
        UserPassword $password,
        Repository $config
    ) {
        $user = $users->findByEmail($builder->getFormValue('email'));

        if ($path = $builder->getFormOption('reset_path')) {
            $config->set('anomaly.module.users::paths.reset', $path);
        }

        $password->forgot($user);
        $password->send($user, $builder->getFormOption('reset_redirect'));
    }
}
