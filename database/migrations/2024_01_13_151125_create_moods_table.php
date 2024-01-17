<?php

use App\Enums\Moods;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moods', function (Blueprint $table) {
            $table->foreignUuid('travelId')->constrained('travels')->cascadeOnDelete();
            $table->unsignedTinyInteger(Moods::NATURE->value)->default(100);
            $table->unsignedTinyInteger(Moods::RELAX->value)->default(100);
            $table->unsignedTinyInteger(Moods::HISTORY->value)->default(100);
            $table->unsignedTinyInteger(Moods::CULTURE->value)->default(100);
            $table->unsignedTinyInteger(Moods::PARTY->value)->default(100);
            $table->timestamps();
            $table->primary('travelId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_moods');
    }
};
