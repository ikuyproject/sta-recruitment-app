<x-admin.layout>

    <x-slot name="header">
        ข้อมูลความสนใจ (Interest Forms)
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="w-full min-w-max">
            <thead class="bg-gray-100 text-left text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">ชื่อผู้กรอก</th>
                    <th class="py-3 px-4">สาขาที่สนใจ</th>
                    <th class="py-3 px-4">เหตุผล</th>
                    <th class="py-3 px-4">วันที่กรอก</th>
                    </tr>
            </thead>

            <tbody class="text-gray-700">
                @forelse ($interestForms as $form)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $form->interest_id }}</td>
                        <td class="py-3 px-4 font-semibold">{{ $form->student->fullname }}</td>
                        <td class="py-3 px-4">{{ $form->program->program_name }}</td>
                        <td class="py-3 px-4 text-sm">{{ $form->reason ?: '-' }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($form->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-4 text-center text-gray-500">
                            --- ยังไม่มีข้อมูลความสนใจ ---
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-admin.layout>