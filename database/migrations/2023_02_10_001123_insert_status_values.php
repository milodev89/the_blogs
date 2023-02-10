<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                'name' => 'Active',
                'table' => 'users',                
                'created_at' => now(),
            ],
            [
                'name' => 'Inactive',
                'table' => 'users',
                'created_at' => now(),
            ],
            [
                'name' => 'Suspended',
                'table' => 'users',
                'created_at' => now(),
            ],
            [
                'name' => 'Active',
                'table' => 'posts',
                'created_at' => now(),
            ],
            [
                'name' => 'In Review',
                'table' => 'posts',
                'created_at' => now(),
            ],            
            [
                'name' => 'Deleted',
                'table' => 'posts',
                'created_at' => now(),
            ],
        ];
        Status::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Status::delete();
    }
};
