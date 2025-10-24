<x-admin.layout>

    <x-slot name="header">
        รายละเอียดใบสมัคร ID: {{ $application->application_id }}
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('admin.applications.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            &larr; กลับไปหน้าตาราง
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    ข้อมูลการสมัคร (ส่วนที่ 3)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong class="text-gray-600 block">สถานะปัจจุบัน:</strong>
                        @if ($application->status == 'ผ่าน')
                            <span class="text-2xl font-bold text-green-600">ผ่าน</span>
                        @elseif ($application->status == 'ไม่ผ่าน')
                            <span class="text-2xl font-bold text-red-600">ไม่ผ่าน</span>
                        @else
                            <span class="text-2xl font-bold text-gray-500">รอตรวจสอบ</span>
                        @endif
                    </div>
                    <div>
                        <strong class="text-gray-600 block">วันที่สมัคร:</strong>
                        <span class="text-lg">{{ \Carbon\Carbon::parse($application->submitted_at)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="md:col-span-2">
                        <strong class="text-gray-600 block">คณะ:</strong>
                        <span class="text-lg">{{ $application->faculty->faculty_name }}</span>
                    </div>
                    <div class="md:col-span-2">
                        <strong class="text-gray-600 block">สาขาวิชาที่สมัคร:</strong>
                        <span class="text-lg font-semibold text-blue-700">{{ $application->program->program_name }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    ข้อมูลการศึกษา (ส่วนที่ 2)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong class="text-gray-600 block">สถานภาพ:</strong>
                        <span class="text-lg">{{ $application->education_status }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">ปีที่สำเร็จ (ถ้ามี):</strong>
                        <span class="text-lg">{{ $application->graduation_year ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">ชื่อสถาบัน:</strong>
                        <span class="text-lg">{{ $application->school_name }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">จังหวัด:</strong>
                        <span class="text-lg">{{ $application->school_province }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">แผนการเรียน:</strong>
                        <span class="text-lg">{{ $application->school_major }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">GPAX:</strong>
                        <span class="text-lg font-bold">{{ number_format($application->gpax, 2) }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">ประเภท GPAX (ถ้ากำลังศึกษา):</strong>
                        <span class="text-lg">{{ $application->gpax_type ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    เอกสารแนบ (ส่วนที่ 4)
                </h3>
                <div class="space-y-3">
                    <a href="{{ Storage::url($application->id_card_file) }}" target="_blank"
                       class="block w-full text-left bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold py-3 px-4 rounded-lg transition-colors">
                        📄 1. (บังคับ) ไฟล์บัตรประจำตัวประชาชน
                    </a>
                    <a href="{{ Storage::url($application->transcript_file) }}" target="_blank"
                       class="block w-full text-left bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold py-3 px-4 rounded-lg transition-colors">
                        📄 2. (บังคับ) ไฟล์ใบระเบียนผลการเรียน (Transcript)
                    </a>
                    @if ($application->graduation_certificate_file)
                        <a href="{{ Storage::url($application->graduation_certificate_file) }}" target="_blank"
                           class="block w-full text-left bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors">
                            📄 3. (แนบมา) ไฟล์ใบรับรองการสำเร็จการศึกษา
                        </a>
                    @endif
                    @if ($application->other_documents_file)
                        <a href="{{ Storage::url($application->other_documents_file) }}" target="_blank"
                           class="block w-full text-left bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors">
                            📄 4. (แนบมา) ไฟล์เอกสารอื่นๆ
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    ข้อมูลผู้สมัคร (ส่วนที่ 1)
                </h3>
                <div class="space-y-3">
                    <div>
                        <strong class="text-gray-600 block">ชื่อ-นามสกุล:</strong>
                        <span class="text-lg">{{ $application->student->prefix }} {{ $application->student->fullname }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">เลข ปชช.:</strong>
                        <span class="text-lg">{{ $application->student->id_card_number }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">วันเกิด / อายุ:</strong>
                        <span class="text-lg">{{ \Carbon\Carbon::parse($application->student->dob)->format('d/m/Y') }} ({{ $application->student->age }} ปี)</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">สัญชาติ / เชื้อชาติ:</strong>
                        <span class="text-lg">{{ $application->student->nationality }} / {{ $application->student->ethnicity }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">ศาสนา:</strong>
                        <span class="text-lg">{{ $application->student->religion }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">อีเมล:</strong>
                        <span class="text-lg">{{ $application->student->email }}</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">เบอร์โทรศัพท์:</strong>
                        <span class="text-lg">{{ $application->student->phone }}</span>
                    </div>
                </div>

                <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2 border-t pt-4">
                    ที่อยู่
                </h4>
                <div class="space-y-3">
                    <p class="text-lg">
                        {{ $application->student->address_house_no }} 
                        {{ $application->student->address_soi ? 'หมู่/ซอย ' . $application->student->address_soi : '' }}
                        {{ $application->student->address_street ? 'ถ. ' . $application->student->address_street : '' }}
                        <br>
                        ต.{{ $application->student->address_subdistrict }}, 
                        อ.{{ $application->student->address_district }}
                        <br>
                        จ.{{ $application->student->address_province }}, {{ $application->student->address_postal_code }}
                    </p>
                </div>

                <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2 border-t pt-4">
                    ผู้ปกครอง
                </h4>
                <div class="space-y-3">
                    <div>
                        <strong class="text-gray-600 block">ชื่อ:</strong>
                        <span class="text-lg">{{ $application->student->parent_name }} ({{ $application->student->parent_relation }})</span>
                    </div>
                    <div>
                        <strong class="text-gray-600 block">เบอร์โทร:</strong>
                        <span class="text-lg">{{ $application->student->parent_phone }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-admin.layout>