<?php

namespace App\Http\Controllers;

use App\Models\CustomerLoundry;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Table;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\PhpWord;

class WordExportCustomerController extends Controller
{
    public function getExport()
    {
        // Mengambil data pelanggan
        $customers = CustomerLoundry::where('user_id', auth()->user()->id)->get();

        // Membuat objek PhpWord
        $phpWord = new PhpWord();

        // Menambahkan bagian (section) baru ke dokumen
        $section = $phpWord->addSection();

        // Menambahkan judul tabel
        $section->addText('Daftar Pelanggan', array('bold' => true, 'size' => 16));

        // Menambahkan tabel
        $table = $section->addTable();
        $styleFirstRow = array('borderBottomSize' => 18); // Gaya untuk baris pertama
        $styleOtherRow = array('borderBottomSize' => 6);  // Gaya untuk baris lainnya

        // Menambahkan header tabel (nama kolom)
        $table->addRow();
        $table->addCell(2000, $styleFirstRow)->addText('ID Customer', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Nama Customer', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('No Telp Customer', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Alamat', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Cuci', array('bold' => true));
        $table->addCell(1000, $styleFirstRow)->addText('Qnt', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Tanggal Masuk', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Harga /kg ', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Harga ', array('bold' => true));
        $table->addCell(2000, $styleFirstRow)->addText('Status Biaya', array('bold' => true));

        // Mengisi data pelanggan ke dalam tabel
        foreach ($customers as $customer) {
            $table->addRow();
            $table->addCell(2000, $styleOtherRow)->addText($customer->id_customer);
            $table->addCell(2000, $styleOtherRow)->addText($customer->name_customer_loundry);
            $table->addCell(2000, $styleOtherRow)->addText($customer->phone_number_customer_loundry);
            $table->addCell(2000, $styleOtherRow)->addText($customer->address_customer_loundry);
            $table->addCell(2000, $styleOtherRow)->addText($customer->spesificationLoundry->name_spesification_loundry);
            $table->addCell(1000, $styleOtherRow)->addText($customer->quantity_loundry . " kg");
            $table->addCell(2000, $styleOtherRow)->addText($customer->start_loundry_customer);
            $table->addCell(2000, $styleOtherRow)->addText('Rp. ' . number_format($customer->spesificationLoundry->price_kg_loundry, 0, ',', '.'));
            $table->addCell(2000, $styleOtherRow)->addText('Rp. ' . number_format($customer->result_price_loundry, 0, ',', '.'));
            $statusBiaya = $customer->address_customer_loundry == 'tidak diantar' ? ' (-)' : ' (Harga include +Rp. 5000)';
            $table->addCell(2000, $styleOtherRow)->addText($statusBiaya);
        }

        // Menyimpan dokumen
        $filename = 'data_customer_loundry.docx';
        $path = storage_path('app/public/' . $filename);
        $phpWord->save($path);

        // Mengembalikan respons dengan link untuk mengunduh dokumen
        return response()->download($path)->deleteFileAfterSend(true);
    }
}
