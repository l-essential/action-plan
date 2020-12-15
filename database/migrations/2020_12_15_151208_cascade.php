<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cascades', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('periode_id');
            $table->string('cascade_file', 500)->nullabke();
            $table->string('cascade_file_img', 500)->nullabke();
            $table->text('cascade_desc')->nullable();

            $table->integer('created_by')->nullable();
            $table->timestamps();
        });

        $SQL = "
            INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
            (34, 'cascades', 'cascades', 'Cascade', 'Cascades', NULL, 'App\\Models\\Cascade', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-12-15 08:34:07', '2020-12-15 08:45:56');
        ";
        \DB::statement($SQL);

        $SQL1 = "

        INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
        (214, 34, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
        (215, 34, 'periode_id', 'select_dropdown', 'Periode', 1, 1, 1, 1, 1, 1, '{}', 2),
        (216, 34, 'cascade_file', 'file', 'File Visio', 1, 1, 1, 1, 1, 1, '{}', 4),
        (217, 34, 'cascade_file_img', 'image', 'File Image', 1, 1, 1, 1, 1, 1, '{}', 5),
        (218, 34, 'cascade_desc', 'text_area', 'Deskripsi', 0, 1, 1, 1, 1, 1, '{}', 6),
        (219, 34, 'created_by', 'my_user_field', 'Dibuat Oleh', 0, 1, 1, 0, 0, 0, '{}', 7),
        (220, 34, 'created_at', 'timestamp', 'Dibuat tanggal', 0, 1, 1, 1, 0, 1, '{}', 8),
        (221, 34, 'updated_at', 'timestamp', 'Diperbarui tanggal', 0, 0, 0, 0, 0, 0, '{}', 9),
        (222, 34, 'cascade_belongsto_reker_periode_relationship', 'relationship', 'Periode', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Reker\\\\RekerPeriode\",\"table\":\"reker_periodes\",\"type\":\"belongsTo\",\"column\":\"periode_id\",\"key\":\"id\",\"label\":\"periode\",\"pivot_table\":\"cascades\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);
        
                ";
        \DB::statement($SQL1);

        $SQL2 = "
            INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
            (112, 'browse_cascades', 'cascades', '2020-12-15 08:34:08', '2020-12-15 08:34:08'),
            (113, 'read_cascades', 'cascades', '2020-12-15 08:34:08', '2020-12-15 08:34:08'),
            (114, 'edit_cascades', 'cascades', '2020-12-15 08:34:08', '2020-12-15 08:34:08'),
            (115, 'add_cascades', 'cascades', '2020-12-15 08:34:08', '2020-12-15 08:34:08'),
            (116, 'delete_cascades', 'cascades', '2020-12-15 08:34:08', '2020-12-15 08:34:08');
        ";
        \DB::statement($SQL2);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cascades');

        DB::table('data_types')->where('id', 34)->delete();
        DB::table('data_rows')->where('data_type_id', 34)->delete();
        DB::table('permissions')->where('table_name', 'cascades')->delete();
    }
}
