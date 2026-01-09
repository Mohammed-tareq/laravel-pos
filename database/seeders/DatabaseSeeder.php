<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\PaymentMethod;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        Item::factory(1000)->create();
        Customer::factory(1000)->create();
        PaymentMethod::factory()->create();


    }
}
