<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;

class DeleteBonus extends Command
{
    protected $signature = 'delete:bonus';
    protected $description = 'Удаление бонусов превыщающий срок 6 месяцев';

    public function __construct()
    {
        parent::__construct();
    }
}
