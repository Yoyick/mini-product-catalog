<?php

namespace App\Controller\Admin;

use App\Entity\Product; 
use App\Controller\Admin\ProductCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // In plaats van de default pagina, sturen we de gebruiker direct naar de Product CRUD
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('Producten', 'fas fa-list', Product::class);
        // yield MenuItem::linkTo(SomeCrudController::class, 'The Label', 'fas fa-list');      
        // yield MenuItem::linkToCrud('Producten', 'fas fa-list', Product::class);
        // yield MenuItem::linkToController('Producten', 'fas fa-list', ProductCrudController::class);
        yield MenuItem::linkToRoute('Producten', 'fas fa-list', 'admin'); 
        // MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // MenuItem::linkToCrud('Producten', 'fas fa-list', Product::class);
    }
}
