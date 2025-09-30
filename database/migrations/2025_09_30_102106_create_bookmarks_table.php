<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            // foreignIdFor��User���f����Tweet���f���̊O���L�[���Ȍ��ɒ�`
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Tweet::class)->constrained()->onDelete('cascade'); // Tweet���f����z��
            $table->timestamps();

            // user_id��tweet_id�̑g�ݍ��킹�Ń��j�[�N��������A�d���u�b�N�}�[�N��h��
            $table->unique(['user_id', 'tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};