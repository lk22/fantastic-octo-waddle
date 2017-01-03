<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * tables to truncate
         *
         * @var $tables
         */
        $tables = array('users', 'notes', 'comments', 'contact_messages', 'categories');

        /**
         * seeders to run
         *
         * @var $seeders
         */
        $seeders = array(
        	UsersTableSeeder::class,
        	NotesTableSeeder::class,
        	CommentsTableSeeder::class,
            MessagesTableSeeder::class,
            CategoriesTableSeeder::class
        );

        // if production is the environment
        if(App::environment() === 'production')
        	exit('i dont allow to override the data from the database');

        // Model::unguard();

        // disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // get usage
        $rustart = getrusage();

        // allow microtime
        $init1 = microtime(true);

        /**
         * truncate tables
         */
        echo "Will truncate " . count($tables) . " tables\n";
        echo "---------------------\n\n";

        foreach($tables as $index => $table)
        {
        	DB::table($table)->truncate();

        	echo $index . ". Truncated table " . $table . "\n";
        }

        /**
         * running seeders
         */
        echo "Calling " . count($seeders) . " seeders\n";
        echo "-------------------\n\n";

        foreach($seeders as $index => $seeder)
        {
        	$this->call($seeder);

        	echo $index . ". seeded tables " . $seeder . "\n";
        }

        $total = microtime(true) - $init1;

        // enable foreign key checks again
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
