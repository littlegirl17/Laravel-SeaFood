<?php

use Illuminate\Database\Migrations\Migration;//Đây là class cơ sở cho tất cả các migration trong Laravel.
use Illuminate\Database\Schema\Blueprint;// Class này cung cấp các phương thức để xác định các cột và chỉ số trong bảng.
use Illuminate\Support\Facades\Schema;//Class này chứa các phương thức để thao tác với cấu trúc cơ sở dữ liệu như tạo bảng, sửa bảng, xóa bảng, v.v.

return new class extends Migration
{
    /**
     * up để thực hiện các thay đổi
     * ví dụ: php artisan migrate  ->  Kết quả: Laravel sẽ thêm cột verification_code vào bảng users.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('verification_code')->nullable(); //thêm một cột mới có tên là verification_code vào bảng users
        });
    }

    /**
     * down để hoàn tác các thay đổi
     * ví dụ: php artisan migrate:rollback  ->  Kết quả: Laravel sẽ xóa cột verification_code khỏi bảng users.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('verification_code');
        });
    }
};