<?php

namespace WebLinks\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use WebLinks\Domain\Link;
use WebLinks\Form\Type\LinkType;

class HomeController {

	/**
     * Home page controller.
     *
     * @param Application $app Silex application
     */

	public function indexAction(Application $app) {
    $links = $app['dao.link']->findAll();
    return $app['twig']->render('index.html.twig', array('links' => $links));
	}

	/**
     * Add link controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addLinkAction(Request $request, Application $app) {

    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
	$link = new Link();
    $linkForm = $app['form.factory']->create(new LinkType(), $link);
    $linkForm->handleRequest($request);
    	if ($linkForm->isSubmitted() && $linkForm->isValid()) {
        $app['dao.link']->save($link);
       $app['session']->getFlashBag()->add('success', 'The link was successfully created.');
   	 }

    return $app['twig']->render('add_form.html.twig', array(
        'title' => 'Ajouter un lien',
        'linkForm' => $linkForm->createView()));
	}
	else
	{
		 $app['session']->getFlashBag()->add('error', 'You have to be connect to add a link.');
		 $links = $app['dao.link']->findAll();
    	return $app['twig']->render('index.html.twig', array('links' => $links));
	}
	
}

	/**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }


}