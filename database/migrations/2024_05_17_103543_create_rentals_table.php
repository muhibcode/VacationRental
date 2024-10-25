<?php

use App\Models\Amenities;
use App\Models\BedRooms;
use App\Models\Booking;
use App\Models\Owner;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->text('address');
            $table->integer('tariff');
            $table->boolean('is_closed')->default(false);
            $table->date('close_from')->nullable();
            $table->date('close_to')->nullable();
            $table->string('rental_type');
            $table->integer('max_guest');
            $table->integer('total_bedrooms');
            $table->integer('total_beds');
            $table->integer('total_baths');
            $table->foreignIdFor(BedRooms::class, 'bedrooms');

            // $table->foreignIdFor(Booking::class, 'booking')->nullable();

            $table->foreignIdFor(UserProfile::class, 'owner');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
