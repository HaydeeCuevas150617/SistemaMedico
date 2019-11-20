<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class BackupBaseDatos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esta es la copia de seguridad de la base de datos.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username=\Config::get('database.connections.mysql.username');
        $password=\Config::get('database.connections.mysql.password');
        $dbname=\Config::get('database.connections.mysql.database');
        
        $filename=$dbname.'.sql';
        exec('C:\xampp\mysql\bin\mysqldump '.$dbname.' -u '.$username.' > '.$filename);
        echo ('Tu base de datos esta guardada en root directory. '.$filename);
        $this->info('Tu base de datos esta guardada en root directory. '.$filename);     
        //C:\xampp\mysql\bin\mysqldump sistemamedico -u root -p > copia.sql
        //sin la -p no pide contraseña ya que no es necesario
    }
}
