<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim'   => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('nim', true);
        $this->forge->createTable('mahasiswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa', true);
    }
}
