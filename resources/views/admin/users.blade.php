@extends('layouts.admin')

@section('title', 'Manajemen Pengguna Admin')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- List Admins Table -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl lg:col-span-2 shadow-2xl">
        <h3 class="text-sm font-bold tracking-wider uppercase text-white mb-6 border-b border-gray-800 pb-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
            Daftar Administrator Aktif
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-800 text-[10px] text-gray-500 uppercase tracking-widest font-semibold">
                        <th class="py-3 px-4">Nama Administrator</th>
                        <th class="py-3 px-4">Alamat Email</th>
                        <th class="py-3 px-4">Tanggal Daftar</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-xs divide-y divide-gray-800/50">
                    @foreach($users as $user)
                    <tr class="hover:bg-white/5 transition-all">
                        <td class="py-3.5 px-4 font-bold text-white flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-emerald-950/40 border border-emerald-400/20 flex items-center justify-center text-[10px] text-emerald-400 uppercase font-bold shrink-0">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            {{ $user->name }}
                            @if(Auth::id() == $user->id)
                            <span class="px-1.5 py-0.5 rounded text-[8px] font-bold bg-amber-500/10 border border-amber-500/20 text-amber-400 uppercase tracking-wide">Anda</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-gray-400 font-medium">{{ $user->email }}</td>
                        <td class="py-3.5 px-4 text-gray-500">{{ $user->created_at->format('d M Y H:i') }}</td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditUserModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')" class="px-2.5 py-1 rounded bg-amber-500/10 border border-amber-500/30 text-amber-400 hover:bg-amber-500/20 transition-all font-bold text-[10px] uppercase">
                                    Edit
                                </button>
                                
                                @if(Auth::id() !== $user->id && count($users) > 1)
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus administrator ini? Tindakan ini permanen!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded bg-rose-500/10 border border-rose-500/30 text-rose-500 hover:bg-rose-500/20 transition-all font-bold text-[10px] uppercase">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Admin Form Box -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl shadow-2xl h-fit">
        <h3 class="text-sm font-bold tracking-wider uppercase text-white mb-6 border-b border-gray-800 pb-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            Tambah Admin Baru
        </h3>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama Lengkap Admin..." class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Alamat Email</label>
                <input type="email" name="email" required placeholder="admin.baru@uinmadura.ac.id" class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Kata Sandi</label>
                <input type="password" name="password" required placeholder="Minimal 6 Karakter..." class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi Kata Sandi..." class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-600 to-yellow-500 text-emerald-950 font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase mt-6">
                Daftarkan Admin
            </button>
        </form>
    </div>
</div>

<!-- ==================== EDIT USER DIALOG MODAL ==================== -->
<div id="edit-user-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-sm hidden">
    <div class="w-full max-w-md glass-panel border border-amber-500/20 rounded-3xl p-6 md:p-8 relative">
        <!-- Close button -->
        <button onclick="closeEditUserModal()" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-black/50 text-gray-400 hover:text-white flex items-center justify-center border border-white/10 hover:border-amber-500/30 transition-all focus:outline-none">
            &times;
        </button>

        <h3 class="text-base font-serif font-bold text-white mb-6 border-b border-gray-800 pb-3">Edit Akun Administrator</h3>

        <form id="edit-user-form" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Nama Lengkap</label>
                <input type="text" id="edit-name" name="name" required class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Alamat Email</label>
                <input type="email" id="edit-email" name="email" required class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div class="p-3 rounded-xl bg-amber-500/5 border border-amber-500/10 text-[9px] text-gray-400 leading-normal mb-2">
                Kosongkan kata sandi di bawah ini jika Anda tidak berniat merubahnya.
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Kata Sandi Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah..." class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1.5">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" placeholder="Kosongkan jika tidak diubah..." class="w-full px-4 py-3 rounded-xl bg-slate-900/40 border border-gray-800 focus:outline-none focus:border-amber-500/50 text-xs text-white">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeEditUserModal()" class="flex-1 py-3 rounded-xl border border-white/10 text-white font-semibold transition-all text-xs uppercase">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-gradient-to-r from-amber-600 to-yellow-500 text-emerald-950 font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditUserModal(id, name, email) {
        document.getElementById('edit-user-form').action = `/admin/users/${id}`;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;

        const modal = document.getElementById('edit-user-modal');
        modal.classList.remove('hidden');
    }

    function closeEditUserModal() {
        const modal = document.getElementById('edit-user-modal');
        modal.classList.add('hidden');
    }
</script>
@endsection
