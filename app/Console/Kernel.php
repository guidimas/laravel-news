<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Limpa a base a cada 5 minutos
        $schedule->call(function () {

            // Desabilita flag de foreign keys
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Limpa a base
            DB::table('comments')->truncate();
            DB::table('news')->truncate();
            DB::table('users')->truncate();

            // Recria a noticia
            $id = DB::table('news')->insertGetId(
                [
                    'title' => 'Lorem Ipsum',
                    'lead' => 'What is Lorem Ipsum?',
                    'image' => 'images/m6Hj8Rfbbor0Wh8pGgx68u1IaVfUCGdNT555S8rG.jpeg',
                    'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                    'created_at' => '2019-03-25 22:00:03',
                    'updated_at' => '2019-03-25 22:00:03',
                ]
            );

            // Com o id, recria o comentario
            DB::table('comments')->insert(
                [
                    'comment' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
                    'news_id' => $id,
                    'created_at' => '2019-03-25 22:02:00',
                    'updated_at' => '2019-03-25 22:02:00',
                ]
            );

            // Habilita flag de foreign keys
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
