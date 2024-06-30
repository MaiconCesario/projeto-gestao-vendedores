<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Venda;
use App\Mail\DailySalesReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class SendDailySalesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales:send-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar relatório diário via e-mail';

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
     * @return int
     */
    public function handle()
    {
        $data_inicial = Carbon::now()->startOfDay();
        $data_final = Carbon::now()->endOfDay();
        $vendas_do_dia = Venda::whereBetween('created_at',[$data_inicial, $data_final])->get();

        $totalVendas = $vendas_do_dia->sum('valor_total');

        Mail::to('testesuportemw@outlook.com')->send(new DailySalesReport($vendas_do_dia, $totalVendas));

      Log::info('O comando sales:send-report está sendo executado.');
    

    }
}
