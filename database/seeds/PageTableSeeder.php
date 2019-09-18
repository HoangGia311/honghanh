<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'primary_image' => null,
            'code' => 'full',
            'is_show' => false
        ]);
        DB::table('vi_pages')->insert([
            'name' => null,
            'is_show' => false
        ]);
        DB::table('pages')->insert([
            'primary_image' => null,
            'code' => 'home',
            'is_show' => true
        ]);
        DB::table('pages')->insert([
            'primary_image' => null,
            'code' => 'post',
            'is_show' => true
        ]);
        DB::table('pages')->insert([
            'primary_image' => null,
            'code' => 'category',
            'is_show' => true
        ]);
        DB::table('pages')->insert([
            'primary_image' => null,
            'is_show' => true
        ]);
    }
}
