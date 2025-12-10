<?php
namespace App\Http\Controllers\Resepsionis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\Ras;
use App\Models\RasHewan;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        $pets = Pet::with(['pemilik.user', 'ras'])->get();
        return view('resepsionis.dashboard-resepsionis', compact('pemilik', 'pets'));
    }
    public function dashboard(Request $request)
    {
        // Jika form langkah 2 dikirim
        if ($request->has('step') && $request->step == 2) {
            // Validasi langkah 2
            $request->validate([
                'nama_pet' => 'required|string|max:255',
                'ras_id' => 'required|exists:ras,id',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:jantan,betina',
            ]);

            $pemilikData = session('registrasi_pemilik');
            if (!$pemilikData) {
                return redirect()->back()->withErrors(['msg' => 'Sesi registrasi tidak valid.']);
            }

            // Simpan pemilik
            $pemilik = Pemilik::create($pemilikData);

            // Simpan pet
            Pet::create([
                'pemilik_id' => $pemilik->id,
                'nama' => $request->nama_pet,
                'ras_id' => $request->ras_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'warna_tanda' => $request->warna_tanda ?? null,
            ]);

            session()->forget('registrasi_pemilik');

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
        }

        // Jika form langkah 1 dikirim
        if ($request->has('step') && $request->step == 1) {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:pemiliks,email',
                'whatsapp' => 'required|string|max:20',
                'alamat' => 'required|string',
            ]);

            // Simpan sementara di session
            session(['registrasi_pemilik' => $request->only(['nama', 'email', 'whatsapp', 'alamat'])]);
            $showStep2 = true;
        } else {
            $showStep2 = false;
        }

        // Ambil data untuk ditampilkan
        $pemilik = Pemilik::with('user')->get();
        $pets = Pet::with('pemilik.user', 'ras')->get();
        $listRas = RasHewan::all();

        return view('/resepsionis/dashboard-resepsionis', compact('pemilik', 'pets', 'listRas', 'showStep2'));
    }
}
