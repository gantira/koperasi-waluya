<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Kategori;
use App\Akun;
use App\Wajib;
use App\Pokok;
use App\Manasuka;
use App\Angsuran;
use App\AngsuranDetail;
use App\Kilat;
use App\KilatDetail;
use App\Transaksi;
use App\Rit;
use Carbon\Carbon;
use Excel;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $data['tahun'] = Transaksi::selectRaw('year(tanggal) year')->groupBy('year')->get();

        return view('laporan.index', $data);
    }

    public function anggota(Request $request)
    {
        $data['user'] = User::search($request->search)->get();
        $transaksi = Transaksi::selectRaw('year(tanggal) year')->groupBy('year')->get();

        if ($request->tahun < $transaksi->min('year')) {
            return redirect('laporan/anggota?search='.$request->search.'&tahun='.$transaksi->max('year'));
        }elseif ($request->tahun > $transaksi->max('year') ) {
            return redirect('laporan/anggota?search='.$request->search.'&tahun='.$transaksi->min('year'));
        }else {
            $tahun = $request->tahun;
        }

        $data['title'] = 'Laporan Anggota '.$tahun;
        $data['pluck_tahun'] = $transaksi->pluck('year', 'year');
        $data['tahun'] = $tahun;

        $jasa_angsuran = AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa');
        $jasa_kilat = KilatDetail::whereYear('tanggal', $tahun)->sum('jasa');
        $provisi_pinjaman = Kilat::whereYear('tanggal', $tahun)->sum('provisi')+Angsuran::whereYear('tanggal', $tahun)->sum('provisi');
        $administrasi = Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+Angsuran::whereYear('tanggal', $tahun)->sum('administrasi');
        $pendapatan = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->selectRaw('*, sum(masuk) as masuk')->get();
        $pengeluaran = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->selectRaw('*, sum(keluar) as keluar')->get();
        $shu = $jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk')-$pengeluaran->sum('keluar');  

        $data['shu_simpanan'] = $shu * Setting::value('jasa_simpanan')/100;
        $data['shu_pinjaman'] = $shu * Setting::value('jasa_pinjaman')/100;
        $data['jasa'] = ($jasa_angsuran+$jasa_kilat) * Setting::value('jasa_pinjaman')/100;
        $data['pokok'] = Pokok::selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $data['simpanan'] = ($shu * Setting::value('jasa_simpanan')/100);
        $data['wajibpokok'] = Pokok::selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo') + Wajib::selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $data['jasaanggota'] = AngsuranDetail::sum('jasa') + KilatDetail::sum('jasa');

        if ($request->print) {
            Excel::create('Laporan Anggota '.$tahun, function($excel) use($data) {

                $excel->sheet('New sheet', function($sheet) use($data) {

                    $sheet->loadView('laporan.print.anggota', $data);
                    $sheet->cells('A2:L3', function($cells) {

					    $cells->setFontWeight('bold');
					    $cells->setValignment('center');

					});

                })->export('xls');

            });
        }

        return view('laporan.anggota.index', $data);
    }

    public function keuangan(Request $request)
    {
        $transaksi = Transaksi::selectRaw('year(tanggal) year')->groupBy('year')->get();

        if ($request->tahun < $transaksi->min('year')) {
            return redirect('laporan/keuangan?tahun='.$transaksi->max('year'));
        }elseif ($request->tahun > $transaksi->max('year')) {
            return redirect('laporan/keuangan?tahun='.$transaksi->min('year'));
        }else {
            $tahun = $request->tahun;
        }

        $data['title'] = 'Laporan Keuangan '.$tahun;
        $data['tahun'] = $tahun;
        

        // ~~~~~~~~~~~~~~~~~~~~~~~Tahun Now
        // Laba Rugi
        $jasa_angsuran = AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa');
        $jasa_kilat = KilatDetail::whereYear('tanggal', $tahun)->sum('jasa');
        $provisi_pinjaman = Kilat::whereYear('tanggal', $tahun)->sum('provisi')+Angsuran::whereYear('tanggal', $tahun)->sum('provisi');
        $administrasi = Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+Angsuran::whereYear('tanggal', $tahun)->sum('administrasi');
        $pendapatan = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->selectRaw('*, sum(masuk) as masuk')->get();
        $pengeluaran = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->selectRaw('*, sum(keluar) as keluar')->get();
        $shu = $jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk')-$pengeluaran->sum('keluar');       
        $data['jasa_angsuran'] = $jasa_angsuran;
        $data['jasa_kilat'] = $jasa_kilat;
        $data['provisi_pinjaman'] = $provisi_pinjaman;
        $data['administrasi'] = $administrasi;
        $data['pendapatan'] = $pendapatan;
        $data['pengeluaran'] = $pengeluaran;
        $data['shu'] = $shu;
        $data['jumlah_aktiva'] = $shu;

        // Pembagian SHU
        $data['setting'] = Setting::find(1);
        $jasa_pengurus = $shu * Setting::value('jasa_pengurus')/100;
        $jasa_pengawas = $shu * Setting::value('jasa_pengawas')/100;
        $shu_sosial = $shu * Setting::value('shu_sosial')/100;
        $shu_cadangan = $shu * Setting::value('shu_cadangan')/100;
        $jasa_simpanan = $shu * Setting::value('jasa_simpanan')/100;
        $jasa_pinjaman = $shu * Setting::value('jasa_pinjaman')/100;

        $data['jasa_pengurus'] = $jasa_pengurus;
        $data['jasa_pengawas'] = $jasa_pengawas;
        $data['shu_sosial'] = $shu_sosial;
        $data['shu_cadangan'] = $shu_cadangan;
        $data['jasa_simpanan'] = $jasa_simpanan;
        $data['jasa_pinjaman'] = $jasa_pinjaman;
        $data['pembagian_shu'] = $jasa_pengurus+$jasa_pengawas+$shu_sosial+$shu_cadangan+$jasa_simpanan+$jasa_pinjaman;

        // Neraca
        $wajib = Wajib::whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $pokok = Pokok::whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $manasuka = Manasuka::whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $transaksi = Transaksi::whereYear('tanggal', '<=', $tahun)->whereHas('akun', function ($query) { $query->whereNotIn('kode', [1]); })->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $bank = Transaksi::whereYear('tanggal', '<=', $tahun)->whereHas('akun', function ($query) { $query->whereIn('kode', [1]); })->selectRaw('sum(keluar)-sum(masuk) as saldo')->value('saldo');
        $pinjaman = Angsuran::whereYear('tanggal', '<=', $tahun)->sum('pinjam') + Kilat::whereYear('tanggal', '<=', $tahun)->sum('pinjam');
        $bayar_pinjaman = AngsuranDetail::whereYear('tanggal', '<=', $tahun)->sum('subtotal') + KilatDetail::whereYear('tanggal', '<=', $tahun)->sum('subtotal') + Angsuran::whereYear('tanggal', '<=', $tahun)->sum('provisi') + Angsuran::whereYear('tanggal', '<=', $tahun)->sum('administrasi') + Kilat::whereYear('tanggal', '<=', $tahun)->sum('provisi') + Kilat::whereYear('tanggal', '<=', $tahun)->sum('administrasi');
        
        $inventaris = Transaksi::whereYear('tanggal', '<=', $tahun)->whereHas('akun', function ($query) { $query->where('kode', 24); })->sum('keluar');
        $sosial = Transaksi::whereYear('tanggal', '<=', $tahun)->whereHas('akun', function ($query) { $query->where('kode', 2); })->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $cadangan = Transaksi::whereYear('tanggal', '<=', $tahun)->whereHas('akun', function ($query) { $query->where('kode', 3); })->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $piutang_angsuran = Angsuran::whereYear('tanggal', '<=', $tahun)->sum('pinjam') - AngsuranDetail::whereYear('tanggal', '<=', $tahun)->sum('bayar');
        $piutang_kilat = Kilat::whereYear('tanggal', '<=', $tahun)->sum('pinjam') - KilatDetail::whereYear('tanggal', '<=', $tahun)->sum('bayar');

        $kas = $wajib+$pokok+$manasuka+$transaksi+$bayar_pinjaman-$bank-$pinjaman;

        $data['kas'] = $kas;
        $data['pokok'] = $pokok;
        $data['wajib'] = $wajib;
        $data['manasuka'] = $manasuka;
        $data['bank'] = $bank;
        $data['inventaris'] = $inventaris; 
        $data['sosial'] = $sosial;
        $data['cadangan'] = $cadangan;
        $data['piutang_angsuran'] = $piutang_angsuran;
        $data['piutang_kilat'] = $piutang_kilat;


        // ~~~~~~~~~~~~~~~~~~~~~~~~Tahun Before
        // Laba Rugi
        $jasa_angsuran_before = AngsuranDetail::whereYear('tanggal', $tahun-1)->sum('jasa');
        $jasa_kilat_before = KilatDetail::whereYear('tanggal', $tahun-1)->sum('jasa');
        $provisi_pinjaman_before = Kilat::whereYear('tanggal', $tahun-1)->sum('provisi')+Angsuran::whereYear('tanggal', $tahun-1)->sum('provisi');
        $administrasi_before = Kilat::whereYear('tanggal', $tahun-1)->sum('administrasi')+Angsuran::whereYear('tanggal', $tahun-1)->sum('administrasi');
        $pendapatan_before = Transaksi::whereYear('tanggal', $tahun-1)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->selectRaw('*, sum(masuk) as masuk')->get();
        $pengeluaran_before = Transaksi::whereYear('tanggal', $tahun-1)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->selectRaw('*, sum(keluar) as keluar')->get();
        $shu_before = $jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk')-$pengeluaran_before->sum('keluar'); 

        $data['jasa_angsuran_before'] = $jasa_angsuran_before;
        $data['jasa_kilat_before'] = $jasa_kilat_before;
        $data['provisi_pinjaman_before'] = $provisi_pinjaman_before;
        $data['administrasi_before'] = $administrasi_before;
        $data['pendapatan_before'] = $pendapatan_before;
        $data['pengeluaran_before'] = $pengeluaran_before;
        $data['shu_before'] = $shu_before;

        // Neraca
        $wajib_before = Wajib::whereYear('tanggal', '<=', $tahun-1)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $pokok_before = Pokok::whereYear('tanggal', '<=', $tahun-1)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $manasuka_before = Manasuka::whereYear('tanggal', '<=', $tahun-1)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $transaksi_before = Transaksi::whereYear('tanggal', '<=', $tahun-1)->whereHas('akun', function ($query) { $query->whereNotIn('kode', [1]); })->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $bank_before = Transaksi::whereYear('tanggal', '<=', $tahun-1)->whereHas('akun', function ($query) { $query->whereIn('kode', [1]); })->selectRaw('sum(keluar)-sum(masuk) as saldo')->value('saldo');
        $pinjaman_before = Angsuran::whereYear('tanggal', '<=', $tahun-1)->sum('pinjam') + Kilat::whereYear('tanggal', '<=', $tahun-1)->sum('pinjam');
        $bayar_pinjaman_before = AngsuranDetail::whereYear('tanggal', '<=', $tahun-1)->sum('subtotal') + KilatDetail::whereYear('tanggal', '<=', $tahun-1)->sum('subtotal') + Angsuran::whereYear('tanggal', '<=', $tahun-1)->sum('provisi') + Angsuran::whereYear('tanggal', '<=', $tahun-1)->sum('administrasi') + Kilat::whereYear('tanggal', '<=', $tahun-1)->sum('provisi') + Kilat::whereYear('tanggal', '<=', $tahun-1)->sum('administrasi');
        
        $data['kas_before'] = $wajib_before+$pokok_before+$manasuka_before+$transaksi_before+$bayar_pinjaman_before-$bank_before-$pinjaman_before;
        $data['pokok_before'] = $pokok_before;
        $data['wajib_before'] = $wajib_before;
        $data['manasuka_before'] = $manasuka_before;
        $data['bank_before'] = $bank_before;
        $data['inventaris_before'] = Transaksi::whereYear('tanggal', '<=', $tahun-1)->whereHas('akun', function ($query) { $query->where('kode', 24); })->sum('keluar');
        $data['sosial_before'] = Transaksi::whereYear('tanggal', '<=', $tahun-1)->whereHas('akun', function ($query) { $query->where('kode', 2); })->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $data['cadangan_before'] = Transaksi::whereYear('tanggal', '<=', $tahun-1)->whereHas('akun', function ($query) { $query->where('kode', 3); })->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo');
        $data['piutang_angsuran_before'] = Angsuran::whereYear('tanggal', '<=', $tahun-1)->sum('pinjam') - AngsuranDetail::whereYear('tanggal', '<=', $tahun-1)->sum('bayar');
        $data['piutang_kilat_before'] = Kilat::whereYear('tanggal', '<=', $tahun-1)->sum('pinjam') - KilatDetail::whereYear('tanggal', '<=', $tahun-1)->sum('bayar');

        if ($request->print) {
            Excel::create('Laporan Keuangan '.$tahun, function($excel) use($data) {

                $excel->sheet('New sheet', function($sheet) use($data) {

                    $sheet->loadView('laporan.print.keuangan', $data);

                })->export('xls');

            });
        }

        return view('laporan.keuangan.index', $data);
    }

    public function labarugi(Request $request)
    {
        $transaksi = Transaksi::selectRaw('year(tanggal) year')->groupBy('year')->get();
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // $data['bulan'] = Transaksi::whereYear('tanggal', $tahun)->selectRaw('month(tanggal) month')->groupBy('month')->get();
        
        $data['tahun'] = $tahun;
        
        if ($tahun && $bulan) {
            // ~~~~~~~~~~~~~~~~~~~~~~~Tahun Now
            // Laba Rugi
            $data['title'] = 'Penjelasan Rugi Laba '.Carbon::now()->startOfMonth()->month($bulan)->format('F').' '.$tahun;
            $data['bulan'] = $bulan;

            $jasa_angsuran = AngsuranDetail::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('jasa');
            $jasa_kilat = KilatDetail::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('jasa');
            $provisi_pinjaman = Kilat::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('provisi')+Angsuran::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('provisi');
            $administrasi = Kilat::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('administrasi')+Angsuran::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('administrasi');
            $pendapatan = Transaksi::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->selectRaw('*, sum(masuk) as masuk');
            $transaksi_pendapatan = Transaksi::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->get();
            $pengeluaran = Transaksi::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->selectRaw('*, sum(keluar) as keluar');
            $transaksi_pengeluaran = Transaksi::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->get();
            $shu = $jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk')-$pengeluaran->sum('keluar');       
            $data['jasa_angsuran'] = $jasa_angsuran;
            $data['jasa_kilat'] = $jasa_kilat;
            $data['provisi_pinjaman'] = $provisi_pinjaman;
            $data['administrasi'] = $administrasi;
            $data['pendapatan'] = $pendapatan;
            $data['transaksi_pendapatan'] = $transaksi_pendapatan;
            $data['transaksi_pengeluaran'] = $transaksi_pengeluaran;
            $data['pengeluaran'] = $pengeluaran;
            $data['shu'] = $shu;
            $data['jumlah_aktiva'] = $shu;

            if ($request->print) {
                Excel::create('Penjelasan Rugi Laba '.$tahun, function($excel) use($data) {

                    $excel->sheet('New sheet', function($sheet) use($data) {

                        $sheet->loadView('laporan.print.labarugi_bulan', $data);

                    })->export('xls');

                });
            }

            return view('laporan.keuangan.labarugi_bulan', $data);

        }elseif ($tahun) {
            // ~~~~~~~~~~~~~~~~~~~~~~~Bulan & Tahun Now
            // Laba Rugi
            $data['title'] = 'Penjelasan Rugi Laba '.$tahun;

            $jasa_angsuran = AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa');
            $jasa_kilat = KilatDetail::whereYear('tanggal', $tahun)->sum('jasa');
            $provisi_pinjaman = Kilat::whereYear('tanggal', $tahun)->sum('provisi')+Angsuran::whereYear('tanggal', $tahun)->sum('provisi');
            $administrasi = Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+Angsuran::whereYear('tanggal', $tahun)->sum('administrasi');
            $pendapatan = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->selectRaw('*, sum(masuk) as masuk');
            $transaksi_pendapatan = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->groupBy('akun_id')->get();
            $pengeluaran = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->selectRaw('*, sum(keluar) as keluar');
            $transaksi_pengeluaran = Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) {  $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->groupBy('akun_id')->get();
            $shu = $jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk')-$pengeluaran->sum('keluar');       
            $data['jasa_angsuran'] = $jasa_angsuran;
            $data['jasa_kilat'] = $jasa_kilat;
            $data['provisi_pinjaman'] = $provisi_pinjaman;
            $data['administrasi'] = $administrasi;
            $data['pendapatan'] = $pendapatan;
            $data['transaksi_pendapatan'] = $transaksi_pendapatan;
            $data['transaksi_pengeluaran'] = $transaksi_pengeluaran;
            $data['pengeluaran'] = $pengeluaran;
            $data['shu'] = $shu;
            $data['jumlah_aktiva'] = $shu;

            if ($request->print) {
                Excel::create('Penjelasan Rugi Laba '.$tahun, function($excel) use($data) {

                    $excel->sheet('New sheet', function($sheet) use($data) {

                        $sheet->loadView('laporan.print.labarugi', $data);

                    })->export('xls');

                });
            }

            return view('laporan.keuangan.labarugi', $data);
        }
    }

    public function rit(Request $request)
    {
        $transaksi = Rit::selectRaw('year(tanggal) year')->groupBy('year')->get();
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        if ($request->tahun < $transaksi->min('year')) {
            return redirect('laporan/rit?tahun='.$transaksi->max('year'));
        }elseif ($request->tahun > $transaksi->max('year')) {
            return redirect('laporan/rit?tahun='.$transaksi->min('year'));
        }else {
            $tahun = $request->tahun;
        }

        if ($tahun && $bulan) {
            $data['title'] = 'Laporan Rit Bulan '.Carbon::now()->startOfMonth()->month($bulan)->format('F').' '.$tahun;
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['pluck_tahun'] = $transaksi->pluck('year', 'year');

            $data['rit'] = Rit::whereYear('tanggal', $tahun)->groupBy('user_id')->search($request->search)->get();
           
            if ($request->print) {
                Excel::create('Laporan Rit Bulan '.Carbon::now()->startOfMonth()->month($bulan)->format('F').' '.$tahun, function($excel) use ($data) {

                    $excel->sheet('New sheet', function($sheet) use ($data) {

                        $sheet->loadView('laporan.print.rit_bulan', $data);

                    })->export('xls');

                });
            }

            return view('laporan.rit.detail', $data);
        }elseif ($tahun) {
            $data['title'] = 'Laporan Rit '.$tahun;
            $data['tahun'] = $tahun;
            $data['pluck_tahun'] = $transaksi->pluck('year', 'year');

            $data['rit'] = Rit::whereYear('tanggal', $tahun)->groupBy('user_id')->search($request->search)->get();

            if ($request->print) {
                Excel::create('Laporan Rit '.$tahun, function($excel) use($data) {

                    $excel->sheet('New sheet', function($sheet) use($data) {

                        $sheet->loadView('laporan.print.rit', $data);

                    })->export('xls');

                });
            }

            return view('laporan.rit.index', $data);
        }else {
            $data['title'] = 'Laporan Rit';
            $data['tahun'] = $tahun;
            $data['pluck_tahun'] = $transaksi->pluck('year', 'year');

            $data['rit'] = Rit::whereYear('tanggal', $tahun)->groupBy('user_id')->search($request->search)->get();

            return view('laporan.rit.index', $data);
        }
    }

    public function pengeluaran(Request $request)
    {
        $data['title'] = 'Detail Pengeluaran '. $request->tahun;
        $array = collect([]);
        foreach (Transaksi::whereYear('tanggal', $request->tahun)->whereHas('akun', function ($query) { $query->whereNotIn('kode', [1])->whereKeterangan('keluar')->whereHas('kategori'); })->groupBy('akun_id')->select('akun_id')->get() as $key => $value) {
            $array = $array->push(['kategori_id'=> $value->akun->kategori->id]);
        }
        $array = $array->unique('kategori_id')->implode('kategori_id', ',');

        $data['kategori'] = Kategori::whereIn('id', explode(',', $array))->get();
        $data['tahun'] = $request->tahun;

        if ($request->print) {
                Excel::create('Detail Pengeluaran '.$request->tahun, function($excel) use($data) {

                    $excel->sheet('New sheet', function($sheet) use($data) {

                        $sheet->loadView('laporan.print.pengeluaran', $data);

                    })->export('xls');

                });
            }

        return view('laporan.keuangan.pengeluaran', $data);
    }

}