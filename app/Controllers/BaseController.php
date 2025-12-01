<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected $helpers = ['url', 'form'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    /**
     * Rendu avec template front/admin.
     *
     * @param string $view    ex: 'dashboard/index', 'admin/users/index'
     * @param array  $data
     * @param bool   $isAdmin true = templates/admin, false = templates/front
     */
    protected function view(string $view, array $data = [], bool $isAdmin = false)
    {
        $section = $isAdmin ? 'admin' : 'front';

        // On passe toujours l’utilisateur connecté sous 'currentUser'
        if (! isset($data['currentUser'])) {
            $data['currentUser'] = session('user');
        }

        $output  = view("templates/{$section}/head", $data);
        $output .= view("templates/{$section}/header", $data);
        $output .= view($view, $data);
        $output .= view("templates/{$section}/footer", $data);

        return $output;
    }

    /**
     * Vérifie que l'utilisateur est connecté + admin (role_id = 1).
     *
     * @return array|RedirectResponse
     */
    protected function requireAdmin()
    {
        $user = session('user');

        if (! $user || ! ($user['isLoggedIn'] ?? false)) {
            return redirect()
                ->to(base_url('login'))
                ->with('error', 'Veuillez vous connecter.');
        }

        if ((int) ($user['role_id'] ?? 0) !== 1) {
            return redirect()
                ->to(base_url('/'))
                ->with('error', 'Accès réservé aux administrateurs.');
        }

        return $user;
    }
}
