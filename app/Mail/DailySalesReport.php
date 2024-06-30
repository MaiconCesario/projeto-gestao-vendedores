<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailySalesReport extends Mailable
{
    use Queueable, SerializesModels;

    public $vendas;
    public $totalVendas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendas, $totalVendas)
    {
        $this->vendas = $vendas;
        $this->totalVendas = $totalVendas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.daily_sales_report')
                    ->with([
                        'vendas' => $this->vendas,
                        'totalVendas' => $this->totalVendas,
                    ]);
    }
}
