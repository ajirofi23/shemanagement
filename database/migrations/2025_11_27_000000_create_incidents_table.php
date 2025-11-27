<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            // kategori insiden: work_accident_loss_day, work_accident_light, traffic_accident, fire_accident, forklift_accident, molten_spill_incident, property_damage_incident
            $table->string('type', 64)->index();
            $table->date('occurred_at')->index();
            $table->unsignedInteger('lost_days')->default(0);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });

        Schema::table('incidents', function (Blueprint $table) {
            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};