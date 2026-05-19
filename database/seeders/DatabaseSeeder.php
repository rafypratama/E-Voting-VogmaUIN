<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Initial Admin Account
        User::create([
            'name' => 'UIN Madura Admin',
            'email' => 'admin@uinmadura.ac.id',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Seed Candidates
        $candidates = [
            // PUTRA
            [
                'candidate_number' => '01',
                'name' => 'Achmad Wildan',
                'gender' => 'putra',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Mahasiswa berprestasi Fakultas Tarbiyah angkatan 2023. Aktif dalam organisasi kemahasiswaan dan riset pendidikan berbasis digital. Percaya bahwa integrasi nilai keagamaan dan teknologi adalah kunci masa depan.',
                'vision' => 'Mewujudkan Duta Kampus UIN Madura sebagai katalisator pendidikan inklusif, inovatif, dan berlandaskan nilai luhur kepesantrenan di era digital global.',
                'mission' => json_encode([
                    'Mendorong integrasi teknologi dalam metode pembelajaran mahasiswa.',
                    'Menginisiasi gerakan literasi digital di lingkungan kampus.',
                    'Membangun jejaring kolaborasi dengan perguruan tinggi nasional dan internasional.'
                ]),
                'current_votes' => 482,
            ],
            [
                'candidate_number' => '03',
                'name' => 'Faris Al-Faruq',
                'gender' => 'putra',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Aktivis debat hukum islam dan peraih penghargaan nasional hukum syariah. Memiliki visi untuk menyebarkan moderasi beragama dan kesadaran hukum sipil di kalangan pemuda.',
                'vision' => 'Mewujudkan figur Duta Kampus yang berintegritas tinggi, menjunjung tinggi hukum, dan menjadi pelopor moderasi beragama di tingkat nasional.',
                'mission' => json_encode([
                    'Menyelenggarakan forum advokasi dan edukasi hukum untuk mahasiswa.',
                    'Mengkampanyekan moderasi beragama secara kreatif melalui media sosial.',
                    'Aktif berkontribusi dalam pengabdian masyarakat di Madura.'
                ]),
                'current_votes' => 312,
            ],
            [
                'candidate_number' => '05',
                'name' => 'M. Khairul Anam',
                'gender' => 'putra',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Da\'i muda yang berfokus pada dakwah kreatif berbasis multimedia. Aktif sebagai konten kreator islami dengan pemahaman mendalam tentang ilmu ushuluddin.',
                'vision' => 'Mentransformasikan dakwah kampus menjadi sarana syiar yang sejuk, modis, intelektual, dan menyentuh hati generasi Gen-Z.',
                'mission' => json_encode([
                    'Mendirikan komunitas Dakwah Kreatif Multimedia di UIN Madura.',
                    'Mengadakan pelatihan public speaking dan personal branding untuk mahasiswa.',
                    'Mengembangkan konten edukasi keislaman yang ramah pemuda.'
                ]),
                'current_votes' => 285,
            ],
            [
                'candidate_number' => '07',
                'name' => 'Rahmat Hidayat',
                'gender' => 'putra',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Wirausahawan muda pengembang startup lokal Madura. Bertekad menumbuhkan iklim kemandirian ekonomi mahasiswa berbasis syariah.',
                'vision' => 'Menjadikan mahasiswa UIN Madura mandiri secara finansial melalui ekosistem edupreneurship yang inovatif dan berdaya saing global.',
                'mission' => json_encode([
                    'Menghubungkan inovasi mahasiswa dengan investor industri.',
                    'Mengadakan inkubasi bisnis syariah bagi wirausahawan kampus.',
                    'Memfasilitasi pameran produk kewirausahaan mahasiswa secara berkala.'
                ]),
                'current_votes' => 210,
            ],

            // PUTRI
            [
                'candidate_number' => '02',
                'name' => 'Siti Aisyah',
                'gender' => 'putri',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Peraih IPK sempurna di Fakultas Tarbiyah, fasih berbahasa Arab dan Inggris. Berdedikasi tinggi pada dunia pengajaran anak-anak marjinal di Madura.',
                'vision' => 'Mewujudkan Duta Kampus UIN Madura sebagai teladan akademis dan sosial yang melahirkan pendidik hebat berwawasan global.',
                'mission' => json_encode([
                    'Membuka kelas bahasa asing gratis bagi mahasiswa.',
                    'Mendirikan komunitas relawan pengajar di pelosok Madura.',
                    'Mendorong peningkatan publikasi ilmiah mahasiswa.'
                ]),
                'current_votes' => 521,
            ],
            [
                'candidate_number' => '04',
                'name' => 'Najwa Shihabuddin',
                'gender' => 'putri',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Finalis debat konstitusi tingkat nasional dan penulis aktif isu gender keislaman. Percaya bahwa keadilan hukum islam membawa berkah bagi semua.',
                'vision' => 'Mewujudkan Duta Kampus yang vokal menyuarakan hak-hak akademis dan keadilan sosial dengan berlandaskan keilmuan syariah.',
                'mission' => json_encode([
                    'Menginisiasi gerakan literasi konstitusi dan gender islami.',
                    'Menyediakan pos pengaduan dan bantuan advokasi mahasiswa.',
                    'Menyelenggarakan seminar hukum syariah tingkat nasional.'
                ]),
                'current_votes' => 415,
            ],
            [
                'candidate_number' => '06',
                'name' => 'Zahra Maulida',
                'gender' => 'putri',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Pecinta seni kaligrafi dan pemenang lomba pidato tiga bahasa. Aktif mengenalkan keindahan budaya Madura yang selaras dengan nilai keislaman.',
                'vision' => 'Membangun karakter mahasiswa UIN Madura yang unggul dalam pelestarian budaya lokal religius di kancah internasional.',
                'mission' => json_encode([
                    'Mendirikan wadah seni dan kaligrafi mahasiswa.',
                    'Mengkampanyekan keindahan budaya Madura islami ke luar negeri.',
                    'Mengadakan festival seni budaya islam tahunan.'
                ]),
                'current_votes' => 298,
            ],
            [
                'candidate_number' => '08',
                'name' => 'Alya Nabila',
                'gender' => 'putri',
                'faculty' => 'English Education Department',
                'photo_path' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&q=80&w=600',
                'bio' => 'Juara olimpiade ekonomi islam dan aktif dalam gerakan zakat produktif. Bertekad melahirkan literasi keuangan syariah untuk mahasiswa.',
                'vision' => 'Mewujudkan duta kampus yang terdepan dalam literasi ekonomi islam serta pemanfaatan fintech syariah demi keberdayaan finansial umat.',
                'mission' => json_encode([
                    'Mengedukasi investasi syariah aman bagi kalangan mahasiswa.',
                    'Membangun sistem zakat dan infaq digital kampus.',
                    'Mempelopori gerakan kampanye menabung syariah.'
                ]),
                'current_votes' => 197,
            ],
        ];

        foreach ($candidates as $candidate) {
            Candidate::create($candidate);
        }
    }
}
