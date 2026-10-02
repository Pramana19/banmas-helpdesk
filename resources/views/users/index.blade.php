<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#12544F] leading-tight">
                {{ __('Kelola Karyawan & Teknisi') }}
            </h2>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white hover:bg-blue-800 font-bold py-2 px-4 rounded-md transition-all shadow-sm text-sm border border-transparent dark:border-blue-400/40">
                + Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ editingId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-[#8BBB92]/30 border border-[#8BBB92] text-[#12544F] font-bold px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 font-bold px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-[#8BBB92]/40">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-l-lg">Pengguna</th>
                                <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-r-lg">Aksi & Role</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                                <!-- Kolom Pengguna (Avatar + Form Edit Nama) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-4" x-data="{ name: '{{ $user->name }}' }">
                                    
                                    <!-- Menampilkan Avatar -->
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($user->avatar)
                                            <img class="h-10 w-10 rounded-full object-cover border border-gray-200" src="{{ asset('storage/' . $user->avatar) }}" alt="">
                                        @else
                                            <img class="h-10 w-10 rounded-full object-cover border border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=cbd5e1&color=475569" alt="">
                                        @endif
                                    </div>

                                    <!-- Form Edit Nama -->
                                    <form action="{{ route('users.updateName', $user->id) }}" method="POST" class="flex items-center gap-2"
                                          @submit.prevent="if(confirm('Yakin ingin mengubah nama pengguna ini?')) { $el.submit(); }">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" name="name" x-model="name"
                                               :disabled="editingId !== {{ $user->id }}"
                                               :class="editingId === {{ $user->id }} ? 'bg-white border-[#12544F] ring-1 ring-[#12544F]' : 'bg-transparent border-transparent'"
                                               class="text-sm rounded-md py-1 px-2 font-semibold w-48 transition-all">

                                        <template x-if="editingId !== {{ $user->id }}">
                                            <button type="button" @click="editingId = {{ $user->id }}" class="text-gray-400 hover:text-[#12544F] p-1 bg-gray-50 hover:bg-gray-200 rounded transition-colors" title="Edit Nama">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                        </template>

                                        <template x-if="editingId === {{ $user->id }}">
                                            <div class="flex items-center gap-1">
                                                <button type="submit" class="bg-[#12544F] text-[#EDEDCE] px-2.5 py-1 rounded text-xs font-bold shadow-sm">Selesai</button>
                                                <button type="button" @click="editingId = null; name = '{{ $user->name }}';" class="bg-gray-300 text-gray-700 px-2.5 py-1 rounded text-xs font-bold">Batal</button>
                                            </div>
                                        </template>
                                    </form>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : ($user->role === 'teknisi' ? 'bg-[#8BBB92]/40 text-[#12544F]' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $user->role === 'user' ? 'Karyawan' : ucfirst($user->role) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm flex gap-2 items-center">
                                    @if($user->id === auth()->id())
                                        <span class="text-xs text-gray-400 italic bg-gray-50 px-3 py-1.5 rounded border border-gray-200 inline-block">Admin Utama (Terkunci)</span>
                                    @else
                                        <!-- Form Update Role -->
                                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="flex gap-2 items-center" onsubmit="return confirm('Yakin ingin mengubah role pengguna ini?');">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" :disabled="editingId === {{ $user->id }}" :class="editingId === {{ $user->id }} ? 'opacity-40 cursor-not-allowed bg-gray-100' : 'bg-white'" class="text-sm border-gray-300 rounded-md focus:border-[#12544F] focus:ring-[#8BBB92]">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Karyawan</option>
                                                <option value="teknisi" {{ $user->role == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                                            </select>
                                            <button type="submit" :disabled="editingId === {{ $user->id }}" :class="editingId === {{ $user->id }} ? 'opacity-40 cursor-not-allowed' : 'hover:bg-[#8BBB92] hover:text-[#12544F]'" class="bg-[#12544F] text-[#EDEDCE] px-3 py-1.5 rounded-md transition-all font-semibold text-xs shadow-sm">Update</button>
                                        </form>

                                        <!-- Form Reset Sandi (Logika JS disederhanakan) -->
                                        <form action="{{ route('users.resetPassword', $user->id) }}" method="POST" class="inline-block" x-data @submit.prevent="let newPass = prompt('Masukkan password BARU untuk pengguna {{ $user->name }} (Minimal 8 karakter):'); if(newPass) { if(newPass.length < 8) { alert('Gagal: Password minimal 8 karakter!'); } else { $refs.passInput.value = newPass; $el.submit(); } }">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="password" x-ref="passInput">
                                            <button type="submit" :disabled="editingId === {{ $user->id }}" :class="editingId === {{ $user->id }} ? 'opacity-40 cursor-not-allowed bg-gray-100' : 'bg-blue-50 text-blue-600'" class="font-bold px-3 py-1.5 rounded-md text-xs">Reset Sandi</button>
                                        </form>

                                        <!-- Form Hapus User -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Peringatan: Yakin ingin menghapus pengguna {{ $user->name }}?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" :disabled="editingId === {{ $user->id }}" :class="editingId === {{ $user->id }} ? 'opacity-40 cursor-not-allowed bg-gray-100' : 'bg-red-50 text-red-600'" class="font-bold px-3 py-1.5 rounded-md text-xs">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- AREA PAGINATE -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>