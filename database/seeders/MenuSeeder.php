<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            ['name' => 'Lomie Karet', 'price' => 20000],
            ['name' => 'Lomie Halus', 'price' => 20000],
            ['name' => 'Mie Ayam Karet', 'price' => 15000],
            ['name' => 'Mie Ayam Halus', 'price' => 15000],
            ['name' => 'Siomay', 'price' => 12500],
            ['name' => 'Bakso', 'price' => 12500],
            ['name' => 'Ngohiang', 'price' => 20000],
            ['name' => 'Asinan Buah', 'price' => 25000],
            ['name' => 'Asinan Penganten', 'price' => 25000],
            ['name' => 'Pempek Komplit', 'price' => 20000],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
