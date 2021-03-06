<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function getHome(RequestInterface $request, ResponseInterface $response)
    {
        // Example session helper
        if ($request->getAttribute('name')) {
            $user = $request->getAttribute('name');
        } else {
            // Exemple session helper
            if (!$this->session->has('user')) {
                // Example doctrine
                $users = $this->em->getRepository('App\Entity\User')->queryGetUsers();
                if (!empty($users)) {
                    $user = $users[0]->getName();
                } else {
                    $user = "John";
                }
                $this->session->set('user', $user);
            } else {
                $user = $this->session->get('user');
            }
        }

        // Passer en langue française (un second rafraichissement est necessaire)
        // $this->session->set('lang', 'fr');

        // Example monolog
        if (isset($user)) {
            $this->logger->addInfo("Bienvenue ".$user);
        }

        // Example alerte
        if ($this->session->has('lang') && $this->session->get('lang') == "fr") {
            $this->alert(["Ceci est un message d'alerte de test"], 'danger');
        } else {
            $this->alert(["This is a alert test message"], 'danger');
        }

        $title = "Home";
        $params = compact("user", "title");
        $this->render($response, 'pages/home.twig', $params);
    }

    public function postHome(RequestInterface $request, ResponseInterface $response)
    {
        if ($request->getAttribute('csrf_status') !== false) {
            $_SESSION['name'] = $request->getParam('name');
            if ($this->session->has('lang') && $this->session->get('lang') == "fr") {
                $this->alert(['Vous êtes connecté']);
            } else {
                $this->alert(['You are connected']);
            }
            return $this->redirect($response, 'home');
        } else {
            if ($this->session->has('lang') && $this->session->get('lang') == "fr") {
                $this->alert(['Formulaire invalide'], "danger");
            } else {
                $this->alert(['Invalid form'], "danger");
            }
            return $this->redirect($response, 'home');
        }
    }
}
