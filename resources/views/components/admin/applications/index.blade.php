<x-admin.layout>

    <x-slot name="header">
        ข้อมูลการสมัครเรียน (Application Forms)
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="w-full min-w-max">
            <thead class="bg-gray-100 text-left text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">ชื่อผู้สมัคร</th>
                    <th class="py-3 px-4">สาขาที่สมัคร</th>
                    <th class="py-3 px-4">วันที่สมัคร</th>
                    <th class="py-3 px-4">สถานะ</th>
                    <th class="py-3 px-4">เอกสารแนบ</th>
                    <th class="py-3 px-4">Tools (จัดการ)</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @forelse ($applications as $app)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $app->application_id }}</td>
                        <td class="py-3 px-4 font-semibold">{{ $app->student->fullname }}</td>
                        <td class="py-3 px-4">{{ $app->program->program_name }}</td>
                        <td class="py-3 px-4">{{ $app->submitted_at->format('d/m/Y H:i') }}</td>
                        
                        <td class="py-3 px-4">
                            @if ($app->status == 'ผ่าน')
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    ผ่าน
                                </span>
                            @elseif ($app->status == 'ไม่ผ่าน')
                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    ไม่ผ่าน
                                </span>
                            @else
                                <span class="bg-gray-400 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    รอตรวจสอบ
                                </span>
                            @endif
                        </td>

                        <td class="py-3 px-4">
                            <a href="{{ Storage::url($app->transcript_file) }}" target="_blank"
                               class="text-blue-600 hover:underline text-sm">ใบเกรด</a>
                            |
                            <a href="{{ Storage::url($app->id_card_file) }}" target="_blank"
                               class="text-blue-600 hover:underline text-sm">บัตร ปชช.</a>
                        </td>

                        <td class="py-3 px-4 flex gap-2">
                            <form method="POST" action="{{ route('admin.applications.update-status', $app->application_id) }}" onsubmit="return confirm('ยืนยันอนุมัติ?');">
                                @csrf
                                <input type="hidden" name="status" value="ผ่าน">
                                <button type"submit" 
                                        class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded-full transition-colors">
                                    อนุมัติ
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.applications.update-status', $app->application_id) }}" onsubmit="return confirm('ยืนยันไม่อนุมัติ?');">
                                @csrf
                                <input type="hidden" name="status" value="ไม่ผ่าน">
                                <button type"submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-1 px-3 rounded-full transition-colors">
                                    ไม่อนุมัติ
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 px-4 text-center text-gray-500">
                            --- ยังไม่มีข้อมูลการสมัคร ---
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-admin.layout>