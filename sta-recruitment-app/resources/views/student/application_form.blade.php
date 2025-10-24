<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            แบบฟอร์มสมัครเรียน (Application Form)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-sta-dark overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-white">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-800 text-white p-4 rounded-lg">
                            <strong>เกิดข้อผิดพลาด! กรุณาตรวจสอบข้อมูล:</strong>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('application.form.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <h3 class="text-2xl font-semibold text-sta-yellow mb-6 border-b-2 border-sta-yellow pb-2">
                            ส่วนที่ 1: ข้อมูลส่วนตัว
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <x-input-label for="fullname" value="ชื่อ-นามสกุล (จากระบบ)" class="text-gray-300" />
                                <x-text-input id="fullname" class="block mt-1 w-full bg-gray-600 border-gray-500 text-gray-200" type="text" :value="$student->fullname" disabled />
                            </div>
                            <div>
                                <x-input-label for="email" value="อีเมล (จากระบบ)" class="text-gray-300" />
                                <x-text-input id="email" class="block mt-1 w-full bg-gray-600 border-gray-500 text-gray-200" type="email" :value="$student->email" disabled />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="phone" value="เบอร์โทรศัพท์ (จากระบบ)" class="text-gray-300" />
                                <x-text-input id="phone" class="block mt-1 w-full bg-gray-600 border-gray-500 text-gray-200" type="text" :value="$student->phone" disabled />
                                <p class="text-xs text-gray-400 mt-1">หากต้องการแก้ไขข้อมูล 3 ช่องนี้, กรุณาไปที่หน้า "User Setting"</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                            <div>
                                <x-input-label for="prefix" value="คำนำหน้าชื่อ" class="text-gray-300" />
                                <select id="prefix" name="prefix" class="block mt-1 w-full border-gray-500 bg-gray-600 text-white focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" required>
                                    <option value="">-- เลือก --</option>
                                    <option value="นาย" {{ old('prefix', $student->prefix) == 'นาย' ? 'selected' : '' }}>นาย</option>
                                    <option value="นางสาว" {{ old('prefix', $student->prefix) == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                                    <option value="อื่นๆ" {{ old('prefix', $student->prefix) == 'อื่นๆ' ? 'selected' : '' }}>อื่นๆ</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="id_card_number" value="เลขประจำตัวประชาชน (13 หลัก)" class="text-gray-300" />
                                <x-text-input id="id_card_number" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="id_card_number" :value="old('id_card_number', $student->id_card_number)" required />
                            </div>
                            <div>
                                <x-input-label for="dob" value="วัน/เดือน/ปีเกิด (ค.ศ.)" class="text-gray-300" />
                                <x-text-input id="dob" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="date" name="dob" :value="old('dob', $student->dob)" required />
                            </div>
                            <div>
                                <x-input-label for="age" value="อายุ (ปี)" class="text-gray-300" />
                                <x-text-input id="age" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="number" name="age" :value="old('age', $student->age)" required />
                            </div>
                            <div>
                                <x-input-label for="nationality" value="สัญชาติ" class="text-gray-300" />
                                <x-text-input id="nationality" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="nationality" :value="old('nationality', $student->nationality)" required />
                            </div>
                            <div>
                                <x-input-label for="ethnicity" value="เชื้อชาติ" class="text-gray-300" />
                                <x-text-input id="ethnicity" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="ethnicity" :value="old('ethnicity', $student->ethnicity)" required />
                            </div>
                            <div>
                                <x-input-label for="religion" value="ศาสนา" class="text-gray-300" />
                                <x-text-input id="religion" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="religion" :value="old('religion', $student->religion)" required />
                            </div>
                        </div>

                        <h4 class="text-lg font-semibold text-gray-300 mb-2">ที่อยู่ปัจจุบัน</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                            <div class="md:col-span-1">
                                <x-input-label for="address_house_no" value="บ้านเลขที่" class="text-gray-300" />
                                <x-text-input id="address_house_no" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_house_no" :value="old('address_house_no', $student->address_house_no)" required />
                            </div>
                            <div class="md:col-span-1">
                                <x-input-label for="address_soi" value="หมู่ที่/ซอย" class="text-gray-300" />
                                <x-text-input id="address_soi" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_soi" :value="old('address_soi', $student->address_soi)" />
                            </div>
                            <div class="md:col-span-1">
                                <x-input-label for="address_street" value="ถนน" class="text-gray-300" />
                                <x-text-input id="address_street" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_street" :value="old('address_street', $student->address_street)" />
                            </div>
                            <div>
                                <x-input-label for="address_subdistrict" value="ตำบล/แขวง" class="text-gray-300" />
                                <x-text-input id="address_subdistrict" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_subdistrict" :value="old('address_subdistrict', $student->address_subdistrict)" required />
                            </div>
                            <div>
                                <x-input-label for="address_district" value="อำเภอ/เขต" class="text-gray-300" />
                                <x-text-input id="address_district" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_district" :value="old('address_district', $student->address_district)" required />
                            </div>
                            <div>
                                <x-input-label for="address_province" value="จังหวัด" class="text-gray-300" />
                                <x-text-input id="address_province" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_province" :value="old('address_province', $student->address_province)" required />
                            </div>
                            <div>
                                <x-input-label for="address_postal_code" value="รหัสไปรษณีย์" class="text-gray-300" />
                                <x-text-input id="address_postal_code" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="address_postal_code" :value="old('address_postal_code', $student->address_postal_code)" required />
                            </div>
                        </div>

                        <h4 class="text-lg font-semibold text-gray-300 mb-2">ข้อมูลผู้ปกครอง</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <x-input-label for="parent_name" value="ชื่อ-นามสกุล ผู้ปกครอง" class="text-gray-300" />
                                <x-text-input id="parent_name" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="parent_name" :value="old('parent_name', $student->parent_name)" required />
                            </div>
                            <div>
                                <x-input-label for="parent_phone" value="เบอร์โทรศัพท์" class="text-gray-300" />
                                <x-text-input id="parent_phone" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="parent_phone" :value="old('parent_phone', $student->parent_phone)" required />
                            </div>
                            <div>
                                <x-input-label for="parent_relation" value="ความสัมพันธ์" class="text-gray-300" />
                                <x-text-input id="parent_relation" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="parent_relation" :value="old('parent_relation', $student->parent_relation)" required />
                            </div>
                        </div>

                        <h3 class="text-2xl font-semibold text-sta-yellow mt-10 mb-6 border-b-2 border-sta-yellow pb-2">
                            ส่วนที่ 2: ข้อมูลการศึกษา
                        </h3>
                        
                        <div class="mb-4">
                            <x-input-label value="สถานภาพปัจจุบัน" class="text-gray-300 mb-2" />
                            <div class="space-y-2">
                                <label class="flex items-center text-gray-300"><input type="radio" name="education_status" value="กำลังศึกษาอยู่ ม.6/ปวช." class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('education_status') == 'กำลังศึกษาอยู่ ม.6/ปวช.' ? 'checked' : '' }} required> กำลังศึกษาอยู่ชั้นมัธยมศึกษาปีที่ 6/ปวช.</label>
                                <label class="flex items-center text-gray-300"><input type="radio" name="education_status" value="สำเร็จการศึกษา ม.6/ปวช." class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('education_status') == 'สำเร็จการศึกษา ม.6/ปวช.' ? 'checked' : '' }}> สำเร็จการศึกษาระดับมัธยมศึกษาตอนปลาย/ปวช. แล้ว</label>
                                <label class="flex items-center text-gray-300"><input type="radio" name="education_status" value="กำลังศึกษาอยู่ ปวส." class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('education_status') == 'กำลังศึกษาอยู่ ปวส.' ? 'checked' : '' }}> กำลังศึกษาอยู่ระดับอนุปริญญา/ปวส.</label>
                                <label class="flex items-center text-gray-300"><input type="radio" name="education_status" value="สำเร็จการศึกษา ปวส." class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('education_status') == 'สำเร็จการศึกษา ปวส.' ? 'checked' : '' }}> สำเร็จการศึกษาระดับอนุปริญญา/ปวส. แล้ว</label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                            <div>
                                <x-input-label for="graduation_year" value="ปีการศึกษาที่สำเร็จ (กรณีจบแล้ว)" class="text-gray-300" />
                                <x-text-input id="graduation_year" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="graduation_year" :value="old('graduation_year')" placeholder="เช่น 2567" />
                            </div>
                             <div>
                                <x-input-label for="school_name" value="ชื่อโรงเรียน/สถาบันการศึกษา" class="text-gray-300" />
                                <x-text-input id="school_name" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="school_name" :value="old('school_name')" required />
                            </div>
                            <div>
                                <x-input-label for="school_province" value="จังหวัดของโรงเรียน" class="text-gray-300" />
                                <x-text-input id="school_province" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="school_province" :value="old('school_province')" required />
                            </div>
                            <div>
                                <x-input-label for="school_major" value="แผนการเรียน/แผนก (เช่น วิทย์-คณิต)" class="text-gray-300" />
                                <x-text-input id="school_major" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="school_major" :value="old('school_major')" required />
                            </div>
                            <div>
                                <x-input-label for="gpax" value="เกรดเฉลี่ยสะสม (GPAX)" class="text-gray-300" />
                                <x-text-input id="gpax" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" type="text" name="gpax" :value="old('gpax')" placeholder="เช่น 3.50" required />
                            </div>
                            <div>
                                <x-input-label value="GPAX (สำหรับผู้กำลังศึกษา)" class="text-gray-300" />
                                <div class="mt-1 space-y-1">
                                    <label class="flex items-center text-gray-300"><input type="radio" name="gpax_type" value="4 ภาค" class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('gpax_type') == '4 ภาค' ? 'checked' : '' }}> 4 ภาคการศึกษา</label>
                                    <label class="flex items-center text-gray-300"><input type="radio" name="gpax_type" value="5 ภาค" class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('gpax_type') == '5 ภาค' ? 'checked' : '' }}> 5 ภาคการศึกษา</label>
                                </div>
                            </div>
                        </div>
                        
                        <h3 class="text-2xl font-semibold text-sta-yellow mt-10 mb-6 border-b-2 border-sta-yellow pb-2">
                            ส่วนที่ 3: สาขาวิชาที่ต้องการสมัคร
                        </h3>
                        
                        <div class="mb-4">
                            <x-input-label for="faculty" value="คณะ" class="text-gray-300" />
                            <x-text-input id="faculty" class="block mt-1 w-full bg-gray-600 border-gray-500 text-gray-200" type="text" :value="$faculty->faculty_name" disabled />
                            <input type="hidden" name="faculty_id" value="{{ $faculty->faculty_id }}">
                        </div>

                        <div class="mb-4">
                            <x-input-label value="สาขาวิชา (เลือกได้ 1 สาขา)" class="text-gray-300 mb-2" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                                @foreach ($programs as $program)
                                <label class="flex items-center text-gray-300">
                                    <input type="radio" name="program_id" value="{{ $program->program_id }}" class="mr-2 text-sta-yellow focus:ring-sta-yellow" {{ old('program_id') == $program->program_id ? 'checked' : '' }} required>
                                    {{ $program->program_name }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <h3 class="text-2xl font-semibold text-sta-yellow mt-10 mb-6 border-b-2 border-sta-yellow pb-2">
                            ส่วนที่ 4: เอกสารประกอบการสมัคร
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <x-input-label for="id_card_file" value="1. สำเนาบัตรประจำตัวประชาชน (บังคับ)" class="text-gray-300" />
                                <input id="id_card_file" name="id_card_file" type="file" required accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-300 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sta-yellow file:text-black hover:file:bg-yellow-300">
                                <p class="text-xs text-gray-400 mt-1">ไฟล์ .pdf, .jpg, .png (ขนาดไม่เกิน 2MB)</p>
                            </div>
                            
                            <div>
                                <x-input-label for="transcript_file" value="2. สำเนาใบระเบียนผลการเรียน (บังคับ)" class="text-gray-300" />
                                <input id="transcript_file" name="transcript_file" type="file" required accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-300 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sta-yellow file:text-black hover:file:bg-yellow-300">
                                <p class="text-xs text-gray-400 mt-1">ไฟล์ .pdf, .jpg, .png (ขนาดไม่เกิน 2MB)</p>
                            </div>

                            <div>
                                <x-input-label for="graduation_certificate_file" value="3. สำเนาใบรับรองการสำเร็จการศึกษา (ถ้ามี)" class="text-gray-300" />
                                <input id="graduation_certificate_file" name="graduation_certificate_file" type="file" accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-300 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sta-yellow file:text-black hover:file:bg-yellow-300">
                                <p class="text-xs text-gray-400 mt-1">ไฟล์ .pdf, .jpg, .png (ขนาดไม่เกิน 2MB)</p>
                            </div>

                            <div>
                                <x-input-label for="other_documents_file" value="4. เอกสารอื่นๆ (ถ้ามี เช่น เกียรติบัตร)" class="text-gray-300" />
                                <input id="other_documents_file" name="other_documents_file" type="file" accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-300 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sta-yellow file:text-black hover:file:bg-yellow-300">
                                <p class="text-xs text-gray-400 mt-1">ไฟล์ .pdf, .jpg, .png (ขนาดไม่เกิน 2MB)</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-10">
                            <button type="submit" 
                                    class="w-full px-8 py-3 bg-gradient-to-r from-yellow-400 via-sta-yellow to-yellow-500 text-black text-lg font-bold rounded-md hover:from-yellow-500 hover:to-yellow-600 focus:outline-none focus:ring-2 focus:ring-sta-yellow focus:ring-offset-2 focus:ring-offset-sta-dark">
                                ยื่นใบสมัคร (Submit Application)
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>