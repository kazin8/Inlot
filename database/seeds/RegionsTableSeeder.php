<?php

use Illuminate\Database\Seeder;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class RegionsTableSeeder extends Seeder
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
        $counter = 0;
        $interpreter->addObserver(function(array $row) use (&$counter, &$id) {
            if ($counter) {
                $id = DB::connection('pgsql_classifier')->table('regions')->insertGetId([
                    'id' => $row[0],
                    'country_id' => $row[1],
                    'name' => $row[2]
                ]);
            }
            $counter++;
        });
        $lexer->parse(base_path() . '/resources/handbooks/_regions.csv', $interpreter);
        $id++;
        DB::connection('pgsql_classifier')->statement("ALTER SEQUENCE regions_id_seq RESTART WITH $id;");
    }
}
