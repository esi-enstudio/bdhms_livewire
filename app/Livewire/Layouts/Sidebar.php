<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{

    /**
     * Get filtered menus dynamically.
     */
    public function getMenusProperty(): array
    {
        $menus = [
            // Dashboard
            ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => ''],

            // Category
            ['label' => 'Categories', 'icon' => '', 'children' => [
                // Users
                ['label' => 'Users', 'children' => [
                    ['label' => 'All Users', 'route' => 'user.index', 'permission' => 'view user'],
                    ['label' => 'Add New', 'route' => 'user.create', 'permission' => 'create user'],
                ]],
                // House
                ['label' => 'House', 'children' => [
                    ['label' => 'All House', 'route' => 'houses.index', 'permission' => 'view house'],
                    ['label' => 'Add New', 'route' => 'houses.create', 'permission' => 'create house'],
                ]],
                // Rso
                ['label' => 'Rso', 'children' => [
                    ['label' => 'All Rso', 'route' => 'rso.index', 'permission' => 'view rso'],
                    ['label' => 'Add New', 'route' => 'rso.create', 'permission' => 'create rso'],
                ]],
                // Retailer
                ['label' => 'Retailer', 'children' => [
                    ['label' => 'All Retailers', 'route' => 'retailer.index', 'permission' => 'view retailer'],
                    ['label' => 'Add New', 'route' => 'retailer.create', 'permission' => 'create retailer'],
                ]],
            ]],

            // Services
            ['label' => 'Services', 'icon' => '', 'children' => [
                // Itop Replace
                ['label' => 'Itop Replace', 'children' => [
                    ['label' => 'All Replace', 'route' => 'itopReplace.index', 'permission' => 'view replace'],
                    ['label' => 'Add New', 'route' => 'itopReplace.create', 'permission' => 'create replace'],
                ]],
                // Commissions
                ['label' => 'Commissions', 'children' => [
                    //            ['label' => 'All Commissions', 'route' => 'commission.index', 'permission' => 'view commission'],
                    //            ['label' => 'Add New', 'route' => 'commission.create', 'permission' => 'create commission'],
                ]],
                // Lifting
                ['label' => 'Lifting', 'children' => [
                    //            ['label' => 'All Liftings', 'route' => 'lifting.index', 'permission' => 'view lifting'],
                    //            ['label' => 'Add New', 'route' => 'lifting.create', 'permission' => 'create lifting'],
                ]],
            ]],

            // Inventory
            ['label' => 'Inventory', 'icon' => '', 'children' => [
                // Product
                ['label' => 'Product', 'children' => [
//                    ['label' => 'All Products', 'route' => 'product.index', 'permission' => 'view product'],
//                    ['label' => 'Add New', 'route' => 'product.create', 'permission' => 'create product'],
                ]],
            ]],

            // Authorization
            ['label' => 'Authorization', 'icon' => '', 'permission' => 'show authorization menu', 'children' => [
                // Role
                ['label' => 'Role', 'children' => [
                    ['label' => 'All Roles', 'route' => 'role.index', 'permission' => 'view role'],
                    ['label' => 'Add New', 'route' => 'role.create', 'permission' => 'create role'],
                ]],
                // Permission
                ['label' => 'Permission', 'children' => [
                    ['label' => 'All Permissions', 'route' => 'permission.index', 'permission' => 'view permission'],
                    ['label' => 'Add New', 'route' => 'permission.create', 'permission' => 'create permission'],
                ]],
            ]],
        ];

//        dd('getMenusProperty() is called!', $menus); // Debugging

        return $this->filterMenu($menus);
    }



    public function filterMenu(array $menus): array
    {
        $filteredMenus = [];

        foreach ($menus as $menu) {
            // Check if user has permission for this menu
            if (isset($menu['permission']) && !Auth::user()->can($menu['permission'])) {
                continue; // Skip this menu
            }

            // If this menu has children, apply filtering to them
            if (isset($menu['children'])) {
                $menu['children'] = $this->filterMenu($menu['children']); // Recursive filtering

                // If all children were removed, remove the parent as well
                if (empty($menu['children'])) {
                    continue; // Skip this menu
                }
            }

            // Add the valid menu item to the filtered list
            $filteredMenus[] = $menu;
        }

        return $filteredMenus;
    }

}
