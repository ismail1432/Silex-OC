<?php

namespace WebLinks\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use WebLinks\Domain\link;

class ApiController {

    /**
     * API links controller.
     *
     * @param Application $app Silex application
     *
     * @return All links in JSON format
     */
    public function getLinksAction(Application $app) {
        $links = $app['dao.link']->findAll();
        // Convert an array of objects ($links) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($links as $link) {
            $responseData[] = $this->buildlinkArray($link);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API link details controller.
     *
     * @param integer $id link id
     * @param Application $app Silex application
     *
     * @return link details in JSON format
     */
    public function getLinkAction($id, Application $app) {
        $link = $app['dao.link']->find($id);
        $responseData = $this->buildlinkArray($link);
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API create link controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return link details in JSON format
     */
    public function addLinkAction(Request $request, Application $app) {
        // Check request parameters
        if (!$request->request->has('title')) {
            return $app->json('Missing required parameter: title', 400);
        }
        if (!$request->request->has('content')) {
            return $app->json('Missing required parameter: content', 400);
        }
        // Build and save the new link
        $link = new Link();
        $link->setTitle($request->request->get('title'));
        $link->setContent($request->request->get('url'));
        $app['dao.link']->save($link);
        $responseData = $this->buildlinkArray($link);
        return $app->json($responseData, 201);  // 201 = Created
    }

    /**
     * API delete link controller.
     *
     * @param integer $id link id
     * @param Application $app Silex application
     */
    public function deleteLinkAction($id, Application $app) {
    
        // Delete the link
        $app['dao.link']->delete($id);
        return $app->json('No Content', 204);  // 204 = No content
    }

    /**
     * Converts an link object into an associative array for JSON encoding
     *
     * @param link $link link object
     *
     * @return array Associative array whose fields are the link properties.
     */
    private function buildlinkArray(Link $link) {
        $data  = array(
            'id' => $link->getId(),
            'title' => $link->getTitle(),
            'url' => $link->geturl()
            );
        return $data;
    }
}