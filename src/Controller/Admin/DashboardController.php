<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Russe;
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Flash Cards');
    }

    public function configureMenuItems(): iterable
    {
        /*yield MenuItem::linkToCrud('Russe', 'fa  fa-home', Russe::class);*/
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToRoute('Russe', 'fa  fa-home', 'russe_index'),
            MenuItem::linkToRoute('Polonais', 'fa  fa-home', 'polonais_index'),
            MenuItem::linkToRoute('Allemand', 'fa  fa-home', 'allemand_index'),
            MenuItem::linkToRoute('Espagnol', 'fa  fa-home', 'espagnol_index'),
            MenuItem::linkToRoute('Themes russes', 'fa  fa-home', 'theme_index'),
         
        ];
        
    }
}
