<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateRecurringTransactions extends Command
{
    protected $signature = 'transactions:create-recurring';
    protected $description = 'Membuat transaksi berulang (recurring) yang terlewat dari tanggal mulai hingga hari ini.';

    public function handle()
    {
        $this->info('Memulai pengecekan transaksi berulang...');
        
        $today = Carbon::today();

        // 1. Ambil semua vendor yang aktif dan berulang
        $vendors = Vendor::where('is_active', true)
            ->whereNotNull('recurring_type')
            ->where('vendor_start', '<=', $today)
            ->get();

        if ($vendors->isEmpty()) {
            $this->info('Tidak ada vendor berulang yang aktif.');
            return 0;
        }

        $this->info("Ditemukan {$vendors->count()} vendor berulang aktif untuk diperiksa.");

        foreach ($vendors as $vendor) {
            $this->line("--- Memeriksa Vendor: {$vendor->name} ---");

            // 2. Ambil transaksi terakhir sebagai template
            $templateTransaction = Transaction::where('vendor_id', $vendor->id)->latest('date_transaction')->first();

            if (!$templateTransaction) {
                $this->warn("Tidak ada transaksi template untuk '{$vendor->name}'. Dilewati.");
                continue;
            }

            // 3. Mulai 'perjalanan waktu' dari tanggal mulai vendor
            $cursorDate = Carbon::parse($vendor->vendor_start);
            $endDate = $vendor->vendor_end ? Carbon::parse($vendor->vendor_end) : $today;

            while ($cursorDate->lte($today) && $cursorDate->lte($endDate)) {
                // 4. Cek apakah transaksi untuk periode (bulan & tahun) ini sudah ada
                $isAlreadyCreated = Transaction::where('vendor_id', $vendor->id)
                    ->whereYear('date_transaction', $cursorDate->year)
                    ->whereMonth('date_transaction', $cursorDate->month)
                    ->exists();

                if (!$isAlreadyCreated) {
                    // 5. Jika belum ada, buat transaksi baru!
                    Transaction::create([
                        'vendor_id' => $vendor->id,
                        'category_id' => $templateTransaction->category_id,
                        'date_transaction' => $cursorDate->copy(), // Gunakan tanggal kursor
                        'currency' => $templateTransaction->currency,
                        'amount' => $templateTransaction->amount,
                        'amount_dollar' => $templateTransaction->amount_dollar,
                        'description' => 'Pembayaran ' . $vendor->recurring_type . ' otomatis untuk ' . $vendor->name,
                        'image' => null,
                    ]);
                    $this->info("   -> Transaksi dibuat untuk tanggal: " . $cursorDate->format('d M Y'));
                } else {
                    $this->line("   -> Transaksi untuk " . $cursorDate->format('M Y') . " sudah ada. Dilewati.");
                }

                // 6. Maju ke tanggal pembayaran berikutnya
                if (strtolower($vendor->recurring_type) === 'bulanan') {
                    $cursorDate->addMonth();
                } elseif (strtolower($vendor->recurring_type) === 'tahunan') {
                    $cursorDate->addYear();
                }
            }
        }

        $this->info('Pengecekan selesai.');
        return 0;
    }
}