@extends('layouts.admin')

@section('title', 'Manajemen Finalis Prince & Princess')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-10">
    <!-- Offline Vote Injector Panel -->
    <div class="glass-panel border border-amber-500/20 p-6 rounded-2xl shadow-lg xl:col-span-1 h-fit">
        <h3 class="text-sm font-bold tracking-wider uppercase text-amber-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
            <!-- Lightning icon -->
            <svg class="w-4 h-4 text-amber-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Suntik Suara Offline (Manual)
        </h3>

        <form action="{{ route('admin.votes.inject') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Pilih Finalis (Prince / Princess)</label>
                <select name="candidate_id" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer shadow-sm">
                    <option value="" disabled selected>Pilih salah satu kandidat...</option>
                    @foreach($candidates as $candidate)
                    <option value="{{ $candidate->id }}">{{ $candidate->gender === 'putra' ? 'Prince' : 'Princess' }} {{ $candidate->name }} ({{ $candidate->candidate_number }} - {{ strtoupper($candidate->gender) }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Jumlah Suntikan Suara</label>
                <input type="number" name="vote_amount" required min="1" placeholder="Masukkan angka suara..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Catatan (Alasan)</label>
                <input type="text" name="notes" placeholder="Misal: Input Kupon Offline Kelas..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold tracking-wider hover:shadow-lg hover:shadow-amber-500/20 transition-all text-xs uppercase mt-6">
                Suntikkan Suara
            </button>
        </form>
    </div>

    <!-- Finalists Tables Side-by-Side -->
    <div class="glass-panel border border-amber-500/20 p-6 rounded-2xl xl:col-span-2 shadow-lg">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-6">
            <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                Finalis Terdaftar
            </h3>
            <button onclick="openAddCandidateModal()" class="px-3.5 py-1.5 rounded-lg bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold text-[10px] uppercase tracking-wider transition-all hover:shadow-md hover:shadow-amber-500/10">
                Tambah Finalis
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Prince Column (Putra) -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-blue-700 mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">
                    <span>👑</span> Prince (Putra)
                </h4>
                <div class="overflow-x-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[9px] text-slate-500 uppercase tracking-widest font-semibold">
                                <th class="py-2.5 px-2">Finalis</th>
                                <th class="py-2.5 px-2 text-center">Suara</th>
                                <th class="py-2.5 px-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-50">
                            @forelse($candidates->where('gender', 'putra') as $candidate)
                            <tr class="hover:bg-amber-50/30 transition-all">
                                <td class="py-3 px-2">
                                    <div class="flex items-center gap-3">
                                        <div class="relative shrink-0">
                                            <img src="{{ $candidate->photo_path }}" class="w-9 h-9 rounded-lg object-cover border border-amber-200 shrink-0">
                                            <span class="absolute -top-1.5 -left-1.5 px-1.5 py-0.5 rounded text-[8px] font-extrabold bg-blue-50 border border-blue-200 text-blue-700 shrink-0">
                                                #{{ $candidate->candidate_number }}
                                            </span>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="block text-xs font-bold text-slate-800 truncate max-w-[125px]">{{ $candidate->name }}</span>
                                            <span class="block text-[9px] text-slate-500 truncate max-w-[125px] font-medium">{{ $candidate->prodi }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-center font-extrabold text-blue-600 text-xs">{{ number_format($candidate->current_votes) }}</td>
                                <td class="py-3 px-2 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        <button onclick="openEditCandidateModal({{ $candidate->id }}, '{{ rawurlencode(json_encode($candidate)) }}')" class="px-2 py-1 rounded bg-amber-50 border border-amber-300 text-amber-700 hover:bg-amber-100 transition-all font-bold text-[9px] uppercase">
                                            Edit
                                        </button>
                                        
                                        <form action="{{ route('admin.candidates.delete', $candidate->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus finalis {{ $candidate->name }} ini? Semua log transaksi yang terkait akan bermasalah.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 rounded bg-rose-50 border border-rose-300 text-rose-600 hover:bg-rose-100 transition-all font-bold text-[9px] uppercase">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-slate-500 text-[10px]">Belum ada kandidat putra.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Princess Column (Putri) -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-rose-700 mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">
                    <span>👑</span> Princess (Putri)
                </h4>
                <div class="overflow-x-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[9px] text-slate-500 uppercase tracking-widest font-semibold">
                                <th class="py-2.5 px-2">Finalis</th>
                                <th class="py-2.5 px-2 text-center">Suara</th>
                                <th class="py-2.5 px-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-50">
                            @forelse($candidates->where('gender', 'putri') as $candidate)
                            <tr class="hover:bg-amber-50/30 transition-all">
                                <td class="py-3 px-2">
                                    <div class="flex items-center gap-3">
                                        <div class="relative shrink-0">
                                            <img src="{{ $candidate->photo_path }}" class="w-9 h-9 rounded-lg object-cover border border-amber-200 shrink-0">
                                            <span class="absolute -top-1.5 -left-1.5 px-1.5 py-0.5 rounded text-[8px] font-extrabold bg-rose-50 border border-rose-200 text-rose-600 shrink-0">
                                                #{{ $candidate->candidate_number }}
                                            </span>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="block text-xs font-bold text-slate-800 truncate max-w-[125px]">{{ $candidate->name }}</span>
                                            <span class="block text-[9px] text-slate-500 truncate max-w-[125px] font-medium">{{ $candidate->prodi }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-center font-extrabold text-rose-600 text-xs">{{ number_format($candidate->current_votes) }}</td>
                                <td class="py-3 px-2 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        <button onclick="openEditCandidateModal({{ $candidate->id }}, '{{ rawurlencode(json_encode($candidate)) }}')" class="px-2 py-1 rounded bg-amber-50 border border-amber-300 text-amber-700 hover:bg-amber-100 transition-all font-bold text-[9px] uppercase">
                                            Edit
                                        </button>
                                        
                                        <form action="{{ route('admin.candidates.delete', $candidate->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus finalis {{ $candidate->name }} ini? Semua log transaksi yang terkait akan bermasalah.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 rounded bg-rose-50 border border-rose-300 text-rose-600 hover:bg-rose-100 transition-all font-bold text-[9px] uppercase">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-slate-500 text-[10px]">Belum ada kandidat putri.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== ADD CANDIDATE MODAL ==================== -->
<div id="add-candidate-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden overflow-y-auto">
    <div class="w-full max-w-2xl bg-white/95 backdrop-blur-lg border border-amber-500/30 rounded-3xl p-6 md:p-8 relative max-h-[90vh] overflow-y-auto my-8 shadow-2xl">
        <!-- Close button -->
        <button onclick="closeAddCandidateModal()" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-800 flex items-center justify-center border border-slate-200 transition-all focus:outline-none text-xl font-semibold">
            &times;
        </button>

        <h3 class="text-base font-serif font-bold text-slate-800 mb-6 border-b border-slate-100 pb-3">Tambah Finalis Prince / Princess Baru</h3>

        <form action="{{ route('admin.candidates.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Nomor Finalis (Contoh: 01, A1)</label>
                    <input type="text" name="candidate_number" required placeholder="Contoh: 01" class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Nama Lengkap..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Kategori Gender</label>
                    <select name="gender" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer h-[46px] shadow-sm">
                        <option value="putra">PUTRA</option>
                        <option value="putri">PUTRI</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5 flex justify-between items-center">
                        <span>Departemen / Fakultas</span>
                        <button type="button" onclick="addNewFacultyOption('add-faculty-select')" class="text-[9px] uppercase font-bold text-amber-700 hover:text-amber-600 transition-colors">+ Tambah</button>
                    </label>
                    <select name="faculty" id="add-faculty-select" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer h-[46px] shadow-sm">
                        <option value="English Education Department">English Education Department</option>
                        <option value="Tarbiyah">Tarbiyah</option>
                        <option value="FTIK">FTIK</option>
                        <option value="Syariah">Syariah</option>
                        <option value="Ushuluddin">Ushuluddin</option>
                        <option value="Ekonomi & Bisnis Islam">Ekonomi & Bisnis Islam</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5 flex justify-between items-center">
                        <span>Program Studi (Prodi)</span>
                        <button type="button" onclick="addNewProdiOption('add-prodi-select')" class="text-[9px] uppercase font-bold text-amber-700 hover:text-amber-600 transition-colors">+ Tambah</button>
                    </label>
                    <select name="prodi" id="add-prodi-select" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer h-[46px] shadow-sm">
                        <option value="Tadris Bahasa Inggris">Tadris Bahasa Inggris</option>
                        <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                        <option value="Hukum Keluarga Islam">Hukum Keluarga Islam</option>
                        <option value="Ekonomi Syariah">Ekonomi Syariah</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">URL Foto Portrait Finalis</label>
                <input type="url" name="photo_url" required placeholder="https://images.unsplash.com/..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Biografi Pendek / Slogan</label>
                <textarea name="bio" rows="2" placeholder="Biografi singkat..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm"></textarea>
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Visi Utama</label>
                <textarea name="vision" rows="2" placeholder="Visi kandidat..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm"></textarea>
            </div>

            <!-- Dynamic Missions Inputs -->
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold">Misi Aksi (Daftar Misi)</label>
                    <button type="button" onclick="addMissionField('add-mission-list')" class="text-[9px] uppercase font-bold text-amber-700 border border-amber-500/30 px-2 py-1 rounded hover:bg-amber-50 shadow-sm">+ Tambah Baris Misi</button>
                </div>
                <div id="add-mission-list" class="space-y-2">
                    <input type="text" name="missions[]" placeholder="Misi 1..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
                </div>
            </div>

            <div class="flex gap-3 pt-6">
                <button type="button" onclick="closeAddCandidateModal()" class="flex-1 py-3.5 rounded-xl border border-slate-300 text-slate-700 font-bold transition-all text-xs uppercase hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold tracking-wider hover:shadow-lg hover:shadow-amber-500/20 transition-all text-xs uppercase">
                    Simpan Finalis
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== EDIT CANDIDATE MODAL ==================== -->
<div id="edit-candidate-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden overflow-y-auto">
    <div class="w-full max-w-2xl bg-white/95 backdrop-blur-lg border border-amber-500/30 rounded-3xl p-6 md:p-8 relative max-h-[90vh] overflow-y-auto my-8 shadow-2xl">
        <!-- Close button -->
        <button onclick="closeEditCandidateModal()" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-800 flex items-center justify-center border border-slate-200 transition-all focus:outline-none text-xl font-semibold">
            &times;
        </button>

        <h3 class="text-base font-serif font-bold text-slate-800 mb-6 border-b border-slate-100 pb-3">Edit Data Finalis Prince / Princess</h3>

        <form id="edit-candidate-form" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Nomor Finalis</label>
                    <input type="text" id="edit-number" name="candidate_number" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Nama Lengkap</label>
                    <input type="text" id="edit-name" name="name" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Kategori Gender</label>
                    <select id="edit-gender" name="gender" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer h-[46px] shadow-sm">
                        <option value="putra">PUTRA</option>
                        <option value="putri">PUTRI</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5 flex justify-between items-center">
                        <span>Departemen / Fakultas</span>
                        <button type="button" onclick="addNewFacultyOption('edit-faculty-select')" class="text-[9px] uppercase font-bold text-amber-700 hover:text-amber-600 transition-colors">+ Tambah</button>
                    </label>
                    <select name="faculty" id="edit-faculty-select" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer h-[46px] shadow-sm">
                        <option value="English Education Department">English Education Department</option>
                        <option value="Tarbiyah">Tarbiyah</option>
                        <option value="FTIK">FTIK</option>
                        <option value="Syariah">Syariah</option>
                        <option value="Ushuluddin">Ushuluddin</option>
                        <option value="Ekonomi & Bisnis Islam">Ekonomi & Bisnis Islam</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5 flex justify-between items-center">
                        <span>Program Studi (Prodi)</span>
                        <button type="button" onclick="addNewProdiOption('edit-prodi-select')" class="text-[9px] uppercase font-bold text-amber-700 hover:text-amber-600 transition-colors">+ Tambah</button>
                    </label>
                    <select name="prodi" id="edit-prodi-select" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium cursor-pointer h-[46px] shadow-sm">
                        <option value="Tadris Bahasa Inggris">Tadris Bahasa Inggris</option>
                        <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                        <option value="Hukum Keluarga Islam">Hukum Keluarga Islam</option>
                        <option value="Ekonomi Syariah">Ekonomi Syariah</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">URL Foto Portrait Finalis</label>
                <input type="url" id="edit-photo" name="photo_url" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Biografi Pendek / Slogan</label>
                <textarea id="edit-bio" name="bio" rows="2" class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm"></textarea>
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Visi Utama</label>
                <textarea id="edit-vision" name="vision" rows="2" class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm"></textarea>
            </div>

            <!-- Dynamic Missions Inputs -->
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold">Misi Aksi (Daftar Misi)</label>
                    <button type="button" onclick="addMissionField('edit-mission-list')" class="text-[9px] uppercase font-bold text-amber-700 border border-amber-500/30 px-2 py-1 rounded hover:bg-amber-50 shadow-sm">+ Tambah Baris Misi</button>
                </div>
                <div id="edit-mission-list" class="space-y-2">
                    <!-- dynamic input bars -->
                </div>
            </div>

            <div class="flex gap-3 pt-6">
                <button type="button" onclick="closeEditCandidateModal()" class="flex-1 py-3.5 rounded-xl border border-slate-300 text-slate-700 font-bold transition-all text-xs uppercase hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold tracking-wider hover:shadow-lg hover:shadow-amber-500/20 transition-all text-xs uppercase">
                    Simpan Finalis
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mission field appender
    function addMissionField(listId, val = '') {
        const list = document.getElementById(listId);
        const wrapper = document.createElement('div');
        wrapper.className = "flex gap-2 items-center";
        
        wrapper.innerHTML = `
            <input type="text" name="missions[]" value="${val}" placeholder="Masukkan misi aksi..." class="flex-1 px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            <button type="button" onclick="this.parentElement.remove()" class="px-3 py-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 text-xs hover:bg-rose-100 transition-all focus:outline-none font-bold">&times;</button>
        `;
        
        list.appendChild(wrapper);
    }

    // Modal Add
    function openAddCandidateModal() {
        // Reset dynamic mission lists
        document.getElementById('add-mission-list').innerHTML = `
            <input type="text" name="missions[]" placeholder="Misi 1..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
        `;
        const modal = document.getElementById('add-candidate-modal');
        modal.classList.remove('hidden');
    }

    function closeAddCandidateModal() {
        const modal = document.getElementById('add-candidate-modal');
        modal.classList.add('hidden');
    }

    // Modal Edit
    function openEditCandidateModal(id, rawData) {
        const data = JSON.parse(decodeURIComponent(rawData));
        
        document.getElementById('edit-candidate-form').action = `/admin/candidates/${id}`;
        document.getElementById('edit-number').value = data.candidate_number;
        document.getElementById('edit-name').value = data.name;
        document.getElementById('edit-gender').value = data.gender;
        
        // Handle Faculty Select (Add dynamically if not present)
        const editFacultySelect = document.getElementById('edit-faculty-select');
        let hasFacultyOption = false;
        for (let i = 0; i < editFacultySelect.options.length; i++) {
            if (editFacultySelect.options[i].value === data.faculty) {
                hasFacultyOption = true;
                break;
            }
        }
        if (!hasFacultyOption && data.faculty) {
            const opt = document.createElement('option');
            opt.value = data.faculty;
            opt.innerHTML = data.faculty;
            editFacultySelect.appendChild(opt);
        }
        editFacultySelect.value = data.faculty;

        // Handle Prodi Select (Add dynamically if not present)
        const editProdiSelect = document.getElementById('edit-prodi-select');
        let hasProdiOption = false;
        const currentProdi = data.prodi || 'Tadris Bahasa Inggris';
        for (let i = 0; i < editProdiSelect.options.length; i++) {
            if (editProdiSelect.options[i].value === currentProdi) {
                hasProdiOption = true;
                break;
            }
        }
        if (!hasProdiOption && currentProdi) {
            const opt = document.createElement('option');
            opt.value = currentProdi;
            opt.innerHTML = currentProdi;
            editProdiSelect.appendChild(opt);
        }
        editProdiSelect.value = currentProdi;

        document.getElementById('edit-photo').value = data.photo_path;
        document.getElementById('edit-bio').value = data.bio || '';
        document.getElementById('edit-vision').value = data.vision || '';

        // Render dynamic missions
        const missionList = document.getElementById('edit-mission-list');
        missionList.innerHTML = '';
        
        let missions = [];
        try {
            missions = JSON.parse(data.mission) || [];
        } catch (e) {
            missions = [];
        }

        if (missions.length === 0) {
            addMissionField('edit-mission-list');
        } else {
            missions.forEach(mission => {
                addMissionField('edit-mission-list', mission);
            });
        }

        const modal = document.getElementById('edit-candidate-modal');
        modal.classList.remove('hidden');
    }

    // Dynamic prompt adders
    function addNewFacultyOption(selectId) {
        const select = document.getElementById(selectId);
        const name = prompt('Masukkan nama Fakultas / Departemen Baru:');
        if (name && name.trim()) {
            const trimmed = name.trim();
            // Check if already exists
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].value.toLowerCase() === trimmed.toLowerCase()) {
                    select.value = select.options[i].value;
                    return;
                }
            }
            const opt = document.createElement('option');
            opt.value = trimmed;
            opt.innerHTML = trimmed;
            select.appendChild(opt);
            select.value = trimmed;
        }
    }

    function addNewProdiOption(selectId) {
        const select = document.getElementById(selectId);
        const name = prompt('Masukkan nama Program Studi (Prodi) Baru:');
        if (name && name.trim()) {
            const trimmed = name.trim();
            // Check if already exists
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].value.toLowerCase() === trimmed.toLowerCase()) {
                    select.value = select.options[i].value;
                    return;
                }
            }
            const opt = document.createElement('option');
            opt.value = trimmed;
            opt.innerHTML = trimmed;
            select.appendChild(opt);
            select.value = trimmed;
        }
    }

    function closeEditCandidateModal() {
        const modal = document.getElementById('edit-candidate-modal');
        modal.classList.add('hidden');
    }
</script>
@endsection
