<?php
namespace App\Controllers;
use App\Models\PortfolioStackModel;
use App\Models\ProjectModel;

class AdminPortfolioStackController extends BaseController
{
    public function index(): string
    {
        if(!session()->get('admin_logged_in'))
            return redirect()->to(base_url('login'));

        return view('admin/portfolio_stack', [
            'techStacks'   => (new PortfolioStackModel())->getAllOrdered(),
            'projects'     => (new ProjectModel())->getAllOrdered(),
            'adminUsername'=> session()->get('admin_username') ?? 'admin',
        ]);
    }
}