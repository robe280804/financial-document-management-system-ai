<?php

namespace Database\Seeders;

use App\Models\FinancialDocument;
use Database\Factories\FinancialDocumentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancialDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinancialDocument::factory()
            ->count(20)
            ->create([
                'user_id' => 1
            ]);
    }
}
