<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use App\Models\Category;

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
                'name' => 'Politics',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Economics',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Sports',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Technology',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Culture',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Opinion',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Science',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'name' => 'Health',
                'uuid' => Str::uuid()->toString(),
            ],
        ];
        Category::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
