<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLicenseTypesToDrivingSchoolsTable extends Migration
{
    public function up()
    {
        Schema::table('driving_schools', function (Blueprint $table) {
            $table->json('license_types')->nullable()->after('offer');
        });
    }

    public function down()
    {
        Schema::table('driving_schools', function (Blueprint $table) {
            $table->dropColumn('license_types');
        });
    }
}
