<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\KiaCheckin;
use App\Models\KiaAlert;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KiaCheckinController extends Controller
{
    private $knowledgeBase = [
        1 => [
            'edukasi' => [
                "Bayi tumbuh dari sebesar biji beras hingga sebesar jeruk nipis. Pada masa ini otak mulai terbentuk.",
                "Jangan lupa minum Tablet Tambah Darah (TTD) setiap hari untuk mencegah kurang darah!"
            ],
            'red_flags' => ["Mual dan muntah hebat", "Perdarahan", "Demam Tinggi", "Nyeri perut hebat"]
        ],
        2 => [
            'edukasi' => [
                "Bayi tumbuh dari sebesar apel sampai sebesar jagung! Ibu mungkin sudah mulai merasakan tendangan kecil.",
                "Mulai persiapkan tabungan dan donor darah untuk proses melahirkan nanti ya, Bu."
            ],
            'red_flags' => ["Pandangan kabur", "Keluar cairan berbau dari jalan lahir", "Pusing/sakit kepala berat", "Napas pendek dan jantung berdebar kencang"]
        ],
        3 => [
            'edukasi' => [
                "Bayi sudah sebesar pepaya hingga semangka! Waktunya menyambut kehadiran si kecil."
            ],
            'red_flags' => ["Gerakan bayi kurang dari 10 kali dalam 12 jam", "Ketuban pecah sebelum waktunya", "Kejang", "Perdarahan hebat"]
        ]
    ];

    public function index()
    {
        $patient = auth()->user()->patient;

        if (!$patient) {
            return redirect()->route('pasien.dashboard')->with('error', 'Data pasien tidak ditemukan.');
        }

        $trimester = $this->getTrimester($patient->hpht);
        $knowledge = $this->knowledgeBase[$trimester];
        
        // Pick a random edukasi
        $edukasi = $knowledge['edukasi'][array_rand($knowledge['edukasi'])];
        $redFlags = $knowledge['red_flags'];

        // Check if already checked in today
        $todayCheckin = KiaCheckin::where('patient_id', $patient->id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        $consultations = Consultation::where('patient_id', $patient->id)->orderBy('created_at', 'asc')->get();
        $messageCount = Consultation::where('patient_id', $patient->id)->where('sender_role', 'pasien')->count();

        // Get latest alert if any
        $latestAlert = KiaAlert::where('patient_id', $patient->id)
            ->where('is_resolved', false)
            ->latest()
            ->first();

        return view('pasien.health-updates.kia-checkin', compact(
            'patient', 'trimester', 'edukasi', 'redFlags', 'todayCheckin', 'consultations', 'messageCount', 'latestAlert'
        ));
    }

    public function store(Request $request)
    {
        $patient = auth()->user()->patient;
        $trimester = $this->getTrimester($patient->hpht);
        $knowledge = $this->knowledgeBase[$trimester];

        $redFlags = $knowledge['red_flags'];
        
        // Get triggered red flags
        $triggeredFlags = [];
        foreach ($redFlags as $index => $flag) {
            if ($request->has('flag_' . $index)) {
                $triggeredFlags[] = $flag;
            }
        }

        $isSafe = count($triggeredFlags) === 0;

        $checkin = KiaCheckin::create([
            'patient_id' => $patient->id,
            'trimester' => $trimester,
            'is_safe' => $isSafe,
            'answers' => json_encode($triggeredFlags)
        ]);

        if (!$isSafe) {
            KiaAlert::create([
                'patient_id' => $patient->id,
                'kia_checkin_id' => $checkin->id,
                'red_flag_triggered' => implode(', ', $triggeredFlags),
                'is_resolved' => false
            ]);
            
            if ($request->has('from_buku_kia')) {
                return redirect()->route('pasien.buku-kia.index')->with('danger_alert', 'Tanda Bahaya Terdeteksi! Segera hubungi klinik.');
            }
            return redirect()->route('pasien.health-updates.index')->with('danger_alert', 'Tanda Bahaya Terdeteksi!');
        }

        // Add fun fact to session so it can be shown once as a pop-up
        $edukasi = $knowledge['edukasi'][array_rand($knowledge['edukasi'])];
        
        if ($request->has('from_buku_kia')) {
            return redirect()->route('pasien.buku-kia.index')->with('success', 'Catatan harian berhasil disimpan!')->with('tahukah_ibu', $edukasi);
        }
        return redirect()->route('pasien.health-updates.index')->with('tahukah_ibu', $edukasi);
    }

    public function storeChat(Request $request)
    {
        $patient = auth()->user()->patient;

        // Enforce clinic visit lock
        if ($patient->requires_clinic_visit) {
            return back()->with('error', 'Sesi konsultasi dikunci. Bidan meminta Anda segera datang ke klinik untuk pemeriksaan langsung.');
        }

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $messageCount = Consultation::where('patient_id', $patient->id)->where('sender_role', 'pasien')->count();

        if ($messageCount >= 3) {
            return back()->with('error', 'Sesi diskusi mencapai batas. Untuk pemeriksaan komprehensif, silakan kunjungi Klinik Mediva.');
        }

        Consultation::create([
            'patient_id' => $patient->id,
            'sender_role' => 'pasien',
            'message' => $request->message
        ]);

        return back();
    }

    private function getTrimester($hpht)
    {
        if (!$hpht) return 1;

        $hphtDate = Carbon::parse($hpht);
        $diffDays = $hphtDate->diffInDays(now());
        $minggu = floor($diffDays / 7);

        if ($minggu > 13 && $minggu <= 27) return 2;
        if ($minggu > 27) return 3;
        
        return 1;
    }
}
