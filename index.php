<?php
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Load tickets from localStorage equivalent (session or file)
session_start();
if (!isset($_SESSION['tickets'])) {
    $_SESSION['tickets'] = [];
}

// Handle ticket operations
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['page']) && $_GET['page'] === 'tickets') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'create') {
            $newTicket = [
                'id' => uniqid(),
                'title' => $_POST['title'],
                'description' => $_POST['description'] ?? '',
                'status' => $_POST['status'],
                'createdAt' => date('c')
            ];
            $_SESSION['tickets'][] = $newTicket;
        } elseif ($action === 'update' && isset($_POST['id'])) {
            foreach ($_SESSION['tickets'] as &$ticket) {
                if ($ticket['id'] === $_POST['id']) {
                    $ticket['title'] = $_POST['title'];
                    $ticket['description'] = $_POST['description'] ?? '';
                    $ticket['status'] = $_POST['status'];
                    break;
                }
            }
        } elseif ($action === 'delete' && isset($_POST['id'])) {
            $_SESSION['tickets'] = array_filter($_SESSION['tickets'], function($ticket) {
                return $ticket['id'] !== $_POST['id'];
            });
        }
    }
    // Redirect to avoid form resubmission
    header('Location: ?page=tickets');
    exit;
}

// Simple routing based on query parameter
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'dashboard':
        echo $twig->render('components/dashboard.twig', ['title' => 'Dashboard']);
        break;
    case 'login':
        $mode = $_GET['mode'] ?? 'signin';
        echo $twig->render('components/authentication.twig', ['title' => 'Login', 'mode' => $mode]);
        break;
    case 'tickets':
        echo $twig->render('components/ticketmanagement.twig', [
            'title' => 'Ticket Management',
            'tickets' => $_SESSION['tickets']
        ]);
        break;
    case 'home':
    default:
        echo $twig->render('components/home.twig', ['title' => 'Home']);
        break;
}
