<?php
namespace MyBundle\Handler;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * @author: Bouteillier Nicolas <http://www.kaizendo.fr>
 * @license MIT
 */

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;

    function __construct(RouterInterface $router) {
        $this->router = $router;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        /* default route */
        $url = $this->router->generate('default');
        /* get the roles */
        $roles = $token->getUser()->getRoles();
        /* parse roles, and redirect if match */
        foreach ($roles as $role) {
            if ($role == 'ROLE_MODERATOR') {
                $url = $this->router->generate('moderator_dashboard');
            } else {
                $url = $this->router->generate('fos_user_profile_show');
            }
        }

        return new RedirectResponse($url);
    }
}