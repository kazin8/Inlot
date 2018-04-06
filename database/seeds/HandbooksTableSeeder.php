<?php

use Illuminate\Database\Seeder;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class HandbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lexer = new Lexer(new LexerConfig());
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $row) use (&$id) {
            $id = DB::connection('pgsql_classifier')->table('handbooks')->insertGetId([
                'id' => $row[0],
                'name' => $row[1]
            ]);
        });
        $lexer->parse(base_path() . '/resources/handbooks/_handbooks.csv', $interpreter);
        $id++;
        DB::connection('pgsql_classifier')->statement("ALTER SEQUENCE handbooks_id_seq RESTART WITH $id;");
    }
}
