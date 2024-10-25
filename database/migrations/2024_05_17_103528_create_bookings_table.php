<?php

use App\Models\Rental;
use App\Models\Tenant;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->string('no_of_days');
            $table->string('no_of_adults');
            $table->string('no_of_children');
            $table->string('total_amount');
            $table->foreignIdFor(Rental::class);
            $table->foreignIdFor(UserProfile::class, 'tenant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
