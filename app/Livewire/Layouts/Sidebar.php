<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Sidebar extends Component
{
    public array $menus = [
        // Dashboard
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => ''],
        // Category
        ['label' => 'Categories', 'icon' => '', 'children' => [
            // Users
            ['label' => 'Users', 'children' => [
                    ['label' => 'All Users', 'route' => 'user.index'],
                    ['label' => 'Add New', 'route' => 'user.create'],
            ]],
            // House
            ['label' => 'House', 'children' => [
            ['label' => 'All House', 'route' => 'houses.index'],
            ['label' => 'Add New', 'route' => 'houses.create'],
            ]],
            // Rso
            ['label' => 'Rso', 'children' => [
            ['label' => 'All Rso', 'route' => 'rso.index'],
            ['label' => 'Add New', 'route' => 'rso.create'],
            ]],
            // Retailer
            ['label' => 'Retailer', 'children' => [
                    ['label' => 'All Retailers', 'route' => 'retailer.index'],
                    ['label' => 'Add New', 'route' => 'retailer.create'],
            ]],
        ]],
        // Services
        ['label' => 'Services', 'icon' => '', 'children' => [
            // Itop Replace
            ['label' => 'Itop Replace', 'children' => [
                ['label' => 'All Replace', 'route' => 'itopReplace.index'],
                ['label' => 'Add New', 'route' => 'itopReplace.create'],
            ]],
            // Commissions
            ['label' => 'Commissions', 'children' => [
                //            ['label' => 'All Commissions', 'route' => 'commission.index'],
                //            ['label' => 'Add New', 'route' => 'commission.create'],
            ]],
            // Lifting
            ['label' => 'Lifting', 'children' => [
                //            ['label' => 'All Liftings', 'route' => 'lifting.index'],
                //            ['label' => 'Add New', 'route' => 'lifting.create'],
            ]],
        ]],
        // Inventory
        ['label' => 'Inventory', 'icon' => '', 'children' => [
            // Product
            ['label' => 'Product', 'children' => [
//            ['label' => 'All Products', 'route' => 'product.index'],
//            ['label' => 'Add New', 'route' => 'product.create'],
            ]],
        ]],
    ];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('livewire.layouts.sidebar');
    }
}
