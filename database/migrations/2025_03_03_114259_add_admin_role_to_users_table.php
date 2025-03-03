<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAdminRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');

        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('passager', 'chauffeur', 'admin'))");

        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'passager'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');

        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('passager', 'chauffeur'))");

        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'passager'");
    }
}

