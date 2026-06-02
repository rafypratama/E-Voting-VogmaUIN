@extends('layouts.admin')

@section('title', 'Manajemen Pengguna Admin')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- List Admins Table -->
    <div class="glass-panel border border-amber-500/20 p-6 rounded-2xl lg:col-span-2 shadow-lg">
        <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Daftar Administrator Aktif
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] text-slate-500 uppercase tracking-widest font-semibold">
                        <th class="py-3 px-4">Nama Administrator</th>
                        <th class="py-3 px-4">Alamat Email</th>
                        <th class="py-3 px-4">Tanggal Daftar</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-xs divide-y divide-slate-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-amber-50/30 transition-all">
                        <td class="py-3.5 px-4 font-bold text-slate-800 flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-amber-50 border border-amber-200 flex items-center justify-center text-[10px] text-amber-700 uppercase font-bold shrink-0 shadow-sm">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            {{ $user->name }}
                            @if(Auth::id() == $user->id)
                            <span class="px-1.5 py-0.5 rounded text-[8px] font-bold bg-amber-50 border border-amber-300 text-amber-700 uppercase tracking-wide">Anda</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-slate-600 font-medium">{{ $user->email }}</td>
                        <td class="py-3.5 px-4 text-slate-500">{{ $user->created_at->format('d M Y H:i') }}</td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditUserModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')" class="px-2.5 py-1 rounded bg-amber-50 border border-amber-300 text-amber-700 hover:bg-amber-100 transition-all font-bold text-[10px] uppercase">
                                    Edit
                                </button>
                                
                                @if(Auth::id() !== $user->id && count($users) > 1)
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus administrator ini? Tindakan ini permanen!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded bg-rose-50 border border-rose-300 text-rose-600 hover:bg-rose-100 transition-all font-bold text-[10px] uppercase">
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
    <div class="glass-panel border border-amber-500/20 p-6 rounded-2xl shadow-lg h-fit">
        <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Tambah Admin Baru
        </h3>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama Lengkap Admin..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Alamat Email</label>
                <input type="email" name="email" required placeholder="admin.baru@uinmadura.ac.id" class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Kata Sandi</label>
                <input type="password" name="password" required placeholder="Minimal 6 Karakter..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi Kata Sandi..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold tracking-wider hover:shadow-lg hover:shadow-amber-500/20 transition-all text-xs uppercase mt-6">
                Daftarkan Admin
            </button>
        </form>
    </div>
</div>

<!-- ==================== EDIT USER DIALOG MODAL ==================== -->
<div id="edit-user-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
    <div class="w-full max-w-md bg-white/95 backdrop-blur-lg border border-amber-500/30 rounded-3xl p-6 md:p-8 relative shadow-2xl">
        <!-- Close button -->
        <button onclick="closeEditUserModal()" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-800 flex items-center justify-center border border-slate-200 transition-all focus:outline-none text-xl font-semibold">
            &times;
        </button>

        <h3 class="text-base font-serif font-bold text-slate-800 mb-6 border-b border-slate-100 pb-3">Edit Akun Administrator</h3>

        <form id="edit-user-form" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Nama Lengkap</label>
                <input type="text" id="edit-name" name="name" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Alamat Email</label>
                <input type="email" id="edit-email" name="email" required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-[9px] text-slate-600 leading-normal mb-2 shadow-sm font-medium">
                Kosongkan kata sandi di bawah ini jika Anda tidak berniat merubahnya.
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Kata Sandi Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1.5">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" placeholder="Kosongkan jika tidak diubah..." class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeEditUserModal()" class="flex-1 py-3 rounded-xl border border-slate-300 text-slate-700 font-bold transition-all text-xs uppercase hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold tracking-wider hover:shadow-lg hover:shadow-amber-500/20 transition-all text-xs uppercase">
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
