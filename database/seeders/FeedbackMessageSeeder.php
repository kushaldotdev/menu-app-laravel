<?php

namespace Database\Seeders;

use App\Models\FeedbackMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeedbackMessage::factory(2)->create();
    }
}
