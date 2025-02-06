<?php

namespace App\Http\Controllers;
use App\Models\M_resto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



class Home extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


public function dashboard()
{
    $id_level = session()->get('id_level');
    if (!$id_level) {
        return redirect()->route('login');
    }

    $model = new M_resto();
    $userId = session()->get('id_user');
    $username = session()->get('username');

    $where = array('id_user' => session()->get('id_user'));
	$data['user'] = $model->getWhere('tb_user', $where);

    $data['setting'] = $model->getWhere('tb_setting', ['id_setting' => 1]);

    echo view('header', $data);
    echo view('menu', $data);
    echo view('footer');
}

    public function login()
	{
        $model = new M_resto();
        $data['setting'] = $model->getWhere('tb_setting', ['id_setting' => 1]);
		echo view('header',$data);
		echo view('login',$data);
        echo view('footer');
	}

       // tes
       //tolong kaki saya sakit

       public function aksi_login(Request $request)
       {
           $u = $request->input('username');
           $p = $request->input('password');
           $captchaAnswer = $request->input('captcha_answer');
       
           // Log the activity
           $this->logActivity('User melakukan Login');
       
           $user = DB::table('tb_user')
               ->where('username', $u)
               ->where('password', md5($p))
               ->first();
       
           // Offline CAPTCHA answer (should match the one generated in the view)
           if (!$this->isOnline() && !empty($captchaAnswer)) {
               $correctAnswer = $request->input('correct_captcha_answer');
               if ($captchaAnswer != $correctAnswer) {
                   return redirect()->route('login')->with('error', 'Incorrect offline CAPTCHA.');
               }
           }
       
           if ($user) {
               // Handle sessions as usual
               session([
                   'id_user' => $user->id_user,
                   'id_level' => $user->id_level,
                //    'email' => $user->email,
                   'username' => $user->username,
               ]);
       
               // Redirect to the dashboard
               return redirect()->route('dashboard');
           } else {
               return redirect()->route('login')->with('error', 'Invalid username or password.');
           }
       }
       
       // Function to check if the client is online
       private function isOnline()
       {
           // A simple method to check if the client is online (can be more sophisticated)
           return @fopen("http://www.google.com:80/", "r") ? true : false;
       }

       public function logout()
    {
        $model = new M_resto();
        $id_user = session()->get('id_user');
    

        session()->flush();
        return redirect()->route('login'); 
    }
       
       // Function to log activity
       private function logActivity($activity)
       {
           // Data to be inserted into the table
           $data = [
               'id_user'   => session('id_user'), // Access session data in Laravel
               'activity'  => $activity,
               'timestamp' => now(), // Laravel helper for current timestamp
            //    'delete_at' => 0, // Assuming 0 indicates not deleted
           ];
       
           // Insert the data into the 'tb_activity' table using Laravel's DB facade
           DB::table('tb_activity')->insert($data);
       }
    
       public function setting()
       {
           if (session('id_level') == '1') {
               $this->logActivity('User Membuka Menu Setting');
       
               // Ambil data user berdasarkan id_user dari session
               $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();
       
               // Ambil data setting berdasarkan id_setting
               $setting = DB::table('tb_setting')->where('id_setting', 1)->first();
       
               // Kirim data ke view
               $data = [
                   'user' => $user,
                   'setting' => $setting,
               ];
       
               echo view('header', $data);
                   echo view('menu', $data);
                   echo view('setting', $data);
                   echo view('footer');
           } else {
               return redirect()->route('error404');
           }
       }

       public function aksi_e_setting(Request $request)
{
    $this->logActivity('User Melakukan Edit Setting');

    $a = $request->input('nama_web');
    $icon = $request->file('logo_tab');
    $dash = $request->file('logo_dashboard');
    $login = $request->file('logo_login');

    // Data yang akan diupdate
    $data = ['nama_web' => $a];

    // Proses file logo_tab
    if ($icon && $icon->isValid()) {
        $iconPath = $icon->storeAs('public/img/avatar', $icon->getClientOriginalName());
        $data['logo_tab'] = basename($iconPath);
    }

    // Proses file logo_dashboard
    if ($dash && $dash->isValid()) {
        $dashPath = $dash->storeAs('public/img/avatar', $dash->getClientOriginalName());
        $data['logo_dashboard'] = basename($dashPath);
    }

    // Proses file logo_login
    if ($login && $login->isValid()) {
        $loginPath = $login->storeAs('public/img/avatar', $login->getClientOriginalName());
        $data['logo_login'] = basename($loginPath);
    }

    // Update data ke database
    DB::table('tb_setting')->where('id_setting', 1)->update($data);

    return redirect()->route('setting');
}

       public function profile()
       {
           if (session('id_level') == '1') {
               $this->logActivity('User Membuka Menu Profile');
       
               // Ambil data user berdasarkan id_user dari session
               $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();
       
               // Ambil data setting berdasarkan id_setting
               $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

               $darren = DB::table('tb_user')->where('id_user', session('id_user'))->first();
       
               // Kirim data ke view
               $data = [
                   'user' => $user,
                   'setting' => $setting,
                   'darren' => $darren
               ];
       
                echo view('header', $data);
                   echo view('menu', $data);
                   echo view('profile', $data);
                   echo view('footer');
           } else {
               return redirect()->route('login');
           }
       }

       public function activity()
{
    if (session('id_level') > 0) {
        $this->logActivity('User membuka Log Activity');

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Ambil data aktivitas dengan join ke tb_user
        $activities = DB::table('tb_activity')
            ->join('tb_user', 'tb_activity.id_user', '=', 'tb_user.id_user')
            ->select('tb_activity.*', 'tb_user.username')
            ->where('tb_activity.id_user', session('id_user'))
            ->get();

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'erwin' => $activities,
        ];

        echo view('header', $data);
        echo view('menu', $data);
        echo view('activity', $data);
        echo view('footer');
    } else {
        return redirect()->route('login');
    }
}

public function hapus_activity($id)
{
    $this->logActivity('User Melakukan Hapus Activity');

    // Hapus data activity berdasarkan id_activity
    DB::table('tb_activity')->where('id_activity', $id)->delete();

    return redirect()->route('activity');
}

public function user()
{
    if (session('id_level') == '1') {
        $this->logActivity('User Membuka Menu User');

        $model = new M_resto();

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Panggil model dan gunakan method tampil untuk mengambil data dari tb_event
        $erwin = $model->tampil('tb_user');

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'erwin' => $erwin,
        ];

        echo view('header', $data);
            echo view('menu', $data);
            echo view('user', $data);
            echo view('footer');
    } else {
        return redirect()->route('login');
    }
}

public function hapus_user($id)
{
    $this->logActivity('User Melakukan Hapus User');

    // Hapus data activity berdasarkan id_activity
    DB::table('tb_user')->where('id_user', $id)->delete();

    return redirect()->route('user');
}

public function aksi_t_user(Request $request)
{
    $model = new M_resto();

    $this->logActivity('User Melakukan Tambah User');

    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'id_level'   => 'required|integer',
    ]);
        
        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'id_level' => $request->input('id_level'),
            'password' => md5('1'),           // Password otomatis "1" dengan MD5
            'foto'     => 'avatar-3.png',      // Foto otomatis "avatar-3.png"
        ];
        
        $model->tambah('tb_user', $data);
        return redirect()->route('user')->with('success', 'Data user berhasil ditambahkan.');
        // print_r($data);
    }

    public function aksi_e_user(Request $request)
        {
            $model = new M_resto();
        
            $this->logActivity('User Melakukan Edit User');
        
            // Validasi input
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'id_level'   => 'required|integer',
            ]);
        
            // Ambil data dari form
            $id_user = $request->input('id_user');
            $username = $request->input('username');
            $email = $request->input('email');
            $id_level = $request->input('id_level');
        
            // Data yang akan diperbarui
            $data = [
                'username' => $username,
                'email' => $email,
                'id_level' => $id_level,
            ];
        
            // Update data di database
            $model->edit2('tb_user', $data, ['id_user' => $id_user]);
        
            // print_r($data);
            // Redirect kembali ke halaman event dengan pesan sukses
            return redirect()->route('user')->with('success', 'Data user berhasil diperbarui.');
        }  
        
        public function member()
{
    if (session('id_level') == '1') {
        $this->logActivity('User Membuka Menu Member');

        $model = new M_resto();

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Panggil model dan gunakan method tampil untuk mengambil data dari tb_event
        $erwin = $model->tampil('tb_member');

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'erwin' => $erwin,
        ];

        echo view('header', $data);
            echo view('menu', $data);
            echo view('member', $data);
            echo view('footer');
    } else {
        return redirect()->route('login');
    }
}

public function aksi_t_member(Request $request)
{
    $model = new M_resto();

    $this->logActivity('User Melakukan Tambah Member');

    $request->validate([
        'nama_member' => 'required|string|max:255',
        'kode_member' => 'required|string|max:255',
        'expired_member' => 'required|date',
    ]);
        
        $data = [
            'nama_member' => $request->input('nama_member'),
            'kode_member' => $request->input('kode_member'),
            'expired_member' => $request->input('expired_member'),
        ];
        
        $model->tambah('tb_member', $data);
        return redirect()->route('member')->with('success', 'Data member berhasil ditambahkan.');
        // print_r($data);
    }

    public function aksi_e_member(Request $request)
        {
            $model = new M_resto();
        
            $this->logActivity('User Melakukan Edit Member');
        
            // Validasi input
            $request->validate([
                'nama_member' => 'required|string|max:255',
                'kode_member' => 'required|string|max:255',
                'expired_member' => 'required|date',
            ]);
        
            // Ambil data dari form
            $id_member = $request->input('id_member');
            $nama_member = $request->input('nama_member');
            $kode_member = $request->input('kode_member');
            $expired_member = $request->input('expired_member');
        
            // Data yang akan diperbarui
            $data = [
                'nama_member' => $nama_member,
                'kode_member' => $kode_member,
                'expired_member' => $expired_member,
            ];
        
            // Update data di database
            $model->edit2('tb_member', $data, ['id_member' => $id_member]);
        
            // print_r($data);
            // Redirect kembali ke halaman event dengan pesan sukses
            return redirect()->route('member')->with('success', 'Data member berhasil diperbarui.');
        }

public function hapus_member($id)
{
    $this->logActivity('User Melakukan Hapus Member');

    // Hapus data activity berdasarkan id_activity
    DB::table('tb_member')->where('id_member', $id)->delete();

    return redirect()->route('member');
}

public function voucher()
{
    if (session('id_level') == '1') {
        $this->logActivity('User Membuka Menu Voucher');

        $model = new M_resto();

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Panggil model dan gunakan method tampil untuk mengambil data dari tb_event
        $erwin = $model->tampil('tb_voucher');

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'erwin' => $erwin,
        ];

        echo view('header', $data);
            echo view('menu', $data);
            echo view('voucher', $data);
            echo view('footer');
    } else {
        return redirect()->route('login');
    }
}

public function aksi_t_voucher(Request $request)
{
    $model = new M_resto();

    $this->logActivity('User Melakukan Tambah Voucher');

    $request->validate([
        'kode_voucher' => 'required|string|max:255',
        'diskon' => 'required|string|max:255',
        'voucher_expired' => 'required|string|max:255',
    ]);
        
        $data = [
            'kode_voucher' => $request->input('kode_voucher'),
            'diskon' => $request->input('diskon'),
            'voucher_expired' => $request->input('voucher_expired'),
        ];
        
        $model->tambah('tb_voucher', $data);
        return redirect()->route('voucher')->with('success', 'Data voucher berhasil ditambahkan.');
        // print_r($data);
    }

    public function aksi_e_voucher(Request $request)
        {
            $model = new M_resto();
        
            $this->logActivity('User Melakukan Edit Voucher');
        
            // Validasi input
            $request->validate([
                'kode_voucher' => 'required|string|max:255',
                'diskon' => 'required|string|max:255',
                'voucher_expired' => 'required|string|max:255',
            ]);
        
            // Ambil data dari form
            $id_voucher = $request->input('id_voucher');
            $kode_voucher = $request->input('kode_voucher');
            $diskon = $request->input('diskon');
            $voucher_expired = $request->input('voucher_expired');
        
            // Data yang akan diperbarui
            $data = [
                'kode_voucher' => $kode_voucher,
                'diskon' => $diskon,
                'voucher_expired' => $voucher_expired,
            ];
        
            // Update data di database
            $model->edit2('tb_voucher', $data, ['id_voucher' => $id_voucher]);
        
            // print_r($data);
            // Redirect kembali ke halaman event dengan pesan sukses
            return redirect()->route('voucher')->with('success', 'Data voucher berhasil diperbarui.');
        }

public function hapus_voucher($id)
{
    $this->logActivity('User Melakukan Hapus Voucher');

    // Hapus data activity berdasarkan id_activity
    DB::table('tb_voucher')->where('id_voucher', $id)->delete();

    return redirect()->route('voucher');
}

public function menu_kfc()
{
    if (session('id_level') == '1') {
        $this->logActivity('User Membuka Menu KFC');

        $model = new M_resto();

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Panggil model dan gunakan method tampil untuk mengambil data dari tb_event
        $erwin = $model->tampil('tb_menu');

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'erwin' => $erwin,
        ];

        echo view('header', $data);
            echo view('menu', $data);
            echo view('menu_kfc', $data);
            echo view('footer');
    } else {
        return redirect()->route('login');
    }
}

public function aksi_t_menu(Request $request)
{
    $model = new M_resto();

    $this->logActivity('User Melakukan Tambah Menu');

    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'harga' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'kategori' => 'required|in:Makanan,Minuman,Dessert,Paket',
    ]);
        
        $data = [
            'nama_menu' => $request->input('nama_menu'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
        ];
        
        $model->tambah('tb_menu', $data);
        return redirect()->route('menu_kfc')->with('success', 'Data menu berhasil ditambahkan.');
        // print_r($data);
    }

    public function aksi_e_menu(Request $request)
        {
            $model = new M_resto();
        
            $this->logActivity('User Melakukan Edit Menu');
        
            // Validasi input
            $request->validate([
                'nama_menu' => 'required|string|max:255',
                'harga' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
                'kategori' => 'required|in:Makanan,Minuman,Dessert,Paket',
            ]);
        
            // Ambil data dari form
            $id_menu = $request->input('id_menu');
            $nama_menu = $request->input('nama_menu');
            $harga = $request->input('harga');
            $deskripsi = $request->input('deskripsi');
            $kategori = $request->input('kategori');
        
            // Data yang akan diperbarui
            $data = [
                'nama_menu' => $nama_menu,
                'harga' => $harga,
                'deskripsi' => $deskripsi,
                'kategori' => $kategori,
            ];
        
            // Update data di database
            $model->edit2('tb_menu', $data, ['id_menu' => $id_menu]);
        
            // print_r($data);
            // Redirect kembali ke halaman event dengan pesan sukses
            return redirect()->route('menu_kfc')->with('success', 'Data menu berhasil diperbarui.');
        }

public function hapus_menu_kfc($id)
{
    $this->logActivity('User Melakukan Hapus Menu');

    // Hapus data activity berdasarkan id_activity
    DB::table('tb_menu')->where('id_menu', $id)->delete();

    return redirect()->route('menu_kfc');
}

public function kasir()
{
    if (session('id_level') == '1') {
        $this->logActivity('User Membuka Menu Kasir');

        $model = new M_resto();

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Panggil model dan gunakan method tampil untuk mengambil data dari tb_event
        $menu = $model->tampil('tb_menu');

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'menu' => $menu,
        ];

        echo view('header', $data);
            echo view('menu', $data);
            echo view('kasir', $data);
            echo view('footer');
    } else {
        return redirect()->route('login');
    }
}
public function cekMembership(Request $request)
{
    $kode_membership = $request->kode_membership;

    $membership = DB::table('tb_member')
        ->where('kode_member', $kode_membership)
        ->where('expired_member', '>', now())
        ->first();

    if ($membership) {
        return response()->json([
            'status' => 'valid',
            'diskon' => 10
        ]);
    }

    return response()->json([
        'status' => 'invalid',
        'message' => 'Kode membership tidak valid atau telah expired.'
    ]);
}

public function cekVoucher(Request $request)
{
    $kode_voucher = $request->kode_voucher;

    $voucher = DB::table('tb_voucher')
        ->where('kode_voucher', $kode_voucher)
        ->where('voucher_expired', '>', now())
        ->first();

    if ($voucher) {
        return response()->json([
            'status' => 'valid',
            'diskon' => (float) $voucher->diskon
        ]);
    }

    return response()->json([
        'status' => 'invalid',
        'message' => 'Voucher tidak valid atau telah expired.'
    ]);
}

public function aksi_t_transaksi(Request $request)
{
    $model = new M_resto();

    // Ambil data dari request
    $kodeMember = $request->kode_membership;
    $kodeVoucher = $request->kode_voucher;
    $diskon = $request->diskon;
    $total = $request->total;
    $totalakhir = $request->total_akhir;
    $bayar = $request->bayar;
    $kembalian = $request->kembalian;
    $menuList = $request->menu; // Array menu yang dipilih

    // Generate kode transaksi unik
    $kodeTransaksi = 'TRX' . time();

    // Simpan transaksi untuk setiap menu
    foreach ($menuList as $menu) {
        DB::table('tb_transaksi')->insert([
            'kode_member'   => $kodeMember,
            'kode_voucher'  => $kodeVoucher,
            'nama_menu'     => $menu['nama'],
            'kode_transaksi'=> $kodeTransaksi,
            'tanggal'       => Carbon::now(),
            'jumlah'        => $menu['jumlah'], // Menambahkan jumlah
            'total'         => $total,
            'diskon'        => $diskon,
            'total_akhir'   => $totalakhir,
            'bayar'         => $bayar,
            'kembalian'     => $kembalian,
        ]);
    }

    return response()->json(['status' => 'success', 'message' => 'Transaksi berhasil disimpan']);
}


// public function transaksi()
// {
//     if (session('id_level') == '1') {
//         $this->logActivity('User Membuka Transaksi');

//         $model = new M_resto();

//         // Ambil data user berdasarkan id_user dari session
//         $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

//         // Ambil data setting berdasarkan id_setting
//         $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

//         // Panggil model dan gunakan method tampil untuk mengambil data dari tb_event
//         $transaksi = $model->tampil('tb_transaksi');

//         // Kirim data ke view
//         $data = [
//             'user' => $user,
//             'setting' => $setting,
//             'transaksi' => $transaksi,
//         ];

//         echo view('header', $data);
//             echo view('menu', $data);
//             echo view('transaksi', $data);
//             echo view('footer');
//     } else {
//         return redirect()->route('login');
//     }
// }

public function transaksi()
{
    if (session('id_level') == '1') {
        $this->logActivity('User Membuka Transaksi');

        $model = new M_resto();

        // Ambil data user berdasarkan id_user dari session
        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();

        // Ambil data setting berdasarkan id_setting
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        // Ambil hanya satu data per kode_transaksi
        $transaksi = DB::table('tb_transaksi')
    ->select('kode_transaksi', DB::raw('MAX(tanggal) as tanggal')) // Get the latest tanggal for each kode_transaksi
    ->groupBy('kode_transaksi')
    ->orderBy('tanggal', 'DESC')
    ->get();

        // Kirim data ke view
        $data = [
            'user' => $user,
            'setting' => $setting,
            'transaksi' => $transaksi,
        ];

        echo view('header', $data);
        echo view('menu', $data);
        echo view('transaksi', $data);
        echo view('footer');
    } else {
        return redirect()->route('login');
    }
}

// public function filterTransaksi(Request $request)
// {
//     if (session('id_level') == '1') {
//         $this->logActivity('User Melakukan Filter Transaksi');

//         $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();
//         $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

//         $start_date = $request->input('start_date');
//         $end_date = $request->input('end_date');

//         // Gunakan whereRaw untuk membandingkan hanya bagian tanggalnya saja
//         $transaksi = DB::table('tb_transaksi')
//             ->whereRaw("DATE(tanggal) >= ?", [$start_date])  // Membandingkan hanya tanggalnya
//             ->whereRaw("DATE(tanggal) <= ?", [$end_date])    // Membandingkan hanya tanggalnya
//             ->orderBy('tanggal', 'desc')
//             ->get();

//         return view('transaksi', [
//             'user' => $user,
//             'setting' => $setting,
//             'transaksi' => $transaksi,
//         ]);
//     } else {
//         return redirect()->route('login');
//     }
// }

public function filterTransaksi(Request $request)
{
    if (session('id_level') == '1') {
        $this->logActivity('User Melakukan Filter Transaksi');

        $user = DB::table('tb_user')->where('id_user', session('id_user'))->first();
        $setting = DB::table('tb_setting')->where('id_setting', 1)->first();

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Pastikan format tanggal sesuai dengan format yang diterima oleh database
        // Misalnya format tanggal yang diterima adalah 'YYYY-MM-DD'
        // Cek dan ubah format tanggal jika perlu

        // Menggunakan whereRaw untuk membandingkan hanya bagian tanggalnya saja
        $transaksi = DB::table('tb_transaksi')
            ->whereRaw("DATE(tanggal) >= ?", [$start_date])  // Membandingkan hanya tanggalnya
            ->whereRaw("DATE(tanggal) <= ?", [$end_date])    // Membandingkan hanya tanggalnya
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'transaksi' => $transaksi
        ]);
    } else {
        return redirect()->route('login');
    }
}

public function getDetailTransaksi(Request $request)
{
    $kode_transaksi = $request->kode_transaksi;

    $transaksi = DB::table('tb_transaksi')
        ->where('kode_transaksi', $kode_transaksi)
        ->select('kode_transaksi', 'tanggal', 'kode_member', 'kode_voucher', 'jumlah', 'menu', 'total', 'diskon', 'total_akhir', 'bayar', 'kembalian')
        ->first();

    if ($transaksi) {
        return response()->json(['success' => true, 'data' => $transaksi]);
    } else {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
    }
}

    }