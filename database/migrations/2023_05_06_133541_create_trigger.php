<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER total_roll_trigger
            AFTER INSERT ON roll
            FOR EACH ROW
            BEGIN
                UPDATE stok_kain
                SET TOTAL_ROLL = (SELECT COUNT(*) FROM roll WHERE ID_STOK_KAIN = NEW.ID_STOK_KAIN)
                WHERE ID_STOK_KAIN = NEW.ID_STOK_KAIN;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER total_yard_trigger
            AFTER INSERT ON roll
            FOR EACH ROW
            BEGIN
                UPDATE stok_kain
                SET TOTAL_YARD = (SELECT SUM(YARD) FROM roll WHERE ID_STOK_KAIN = NEW.ID_STOK_KAIN)
                WHERE ID_STOK_KAIN = NEW.ID_STOK_KAIN;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER total_roll_trigger1
            AFTER DELETE ON roll
            FOR EACH ROW
            BEGIN
                UPDATE stok_kain
                SET TOTAL_ROLL = (SELECT COUNT(*) FROM roll WHERE ID_STOK_KAIN = OLD.ID_STOK_KAIN)
                WHERE ID_STOK_KAIN = OLD.ID_STOK_KAIN;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER total_yard_trigger1
            AFTER DELETE ON roll
            FOR EACH ROW
            BEGIN
                UPDATE stok_kain
                SET TOTAL_YARD = (SELECT SUM(YARD) FROM roll WHERE ID_STOK_KAIN = OLD.ID_STOK_KAIN)
                WHERE ID_STOK_KAIN = OLD.ID_STOK_KAIN;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER total_roll_trigger');
        DB::unprepared('DROP TRIGGER total_yard_trigger');
        DB::unprepared('DROP TRIGGER total_roll_trigger1');
        DB::unprepared('DROP TRIGGER total_yard_trigger1');
    }
};
