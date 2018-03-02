<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Misfits\Category;

/**
 * Class CategoryTableSeeder 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 */
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Truncate the database table. 
        $table = DB::table('categories');
        $table->delete();

        // Insert categories into the table. 
        Category::create(['module' => 'helpdesk', 'color' => '#000', 'name' => 'Bug', 'description' => 'Used to indicate bugs in the application.']);
        Category::create(['module' => 'Helpdesk', 'color' => '#000', 'name' => 'Question', 'description' => 'Used to indicate question in the application']);
        Category::create(['module' => 'Helpdesk', 'color' => '#000', 'name' => 'Feedback', 'description' => 'Used to indicate feedback in the application']);
    }
}
