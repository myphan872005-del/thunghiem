<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Thêm cột level, mặc định là 1 (Sơ cấp)
        $table->string('level')->default('Sơ cấp')->after('email'); 
        // Hoặc lưu điểm tích lũy
        $table->integer('points')->default(0)->after('level');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['level', 'points']);
    });
}
};
