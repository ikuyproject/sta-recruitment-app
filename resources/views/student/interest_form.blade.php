<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            แบบสอบถามความสนใจในสาขา (Interest Form)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-sta-dark overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-white">

                    <form method="POST" action="{{ route('interest.form.store') }}">
                        @csrf

                        <h3 class="text-2xl font-semibold text-sta-yellow mb-6">
                            ข้อมูลผู้กรอก
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <x-input-label for="fullname" value="ชื่อ-นามสกุล" class="text-gray-300" />
                                <x-text-input id="fullname" class="block mt-1 w-full bg-gray-600 border-gray-500 text-gray-200" 
                                              type="text" 
                                              :value="$student->fullname" 
                                              disabled />
                            </div>
                            
                            <div>
                                <x-input-label for="email" value="Email" class="text-gray-300" />
                                <x-text-input id="email" class="block mt-1 w-full bg-gray-600 border-gray-500 text-gray-200" 
                                              type="email" 
                                              :value="$student->email" 
                                              disabled />
                            </div>
                        </div>

                        <hr class="border-gray-600 my-6">

                        <h3 class="text-2xl font-semibold text-sta-yellow mb-6">
                            ข้อมูลความสนใจ
                        </h3>
                        
                        <div class="mb-4">
                            <x-input-label for="program_id" value="สาขาที่สนใจ" class="text-gray-300" />
                            <select id="program_id" name="program_id" 
                                    class="block mt-1 w-full border-gray-500 bg-gray-600 text-white focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" 
                                    required>
                                <option value="">-- กรุณาเลือกสาขา --</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->program_id }}">
                                        {{ $program->program_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('program_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label value="เหตุผลที่สนใจ (เลือก 1 ข้อ)" class="text-gray-300 mb-2" />
                            <div class="space-y-2" x-data="{ reasonChoice: '{{ old('reason_choice') }}' }">
                                @php
                                    // ใช้ Choice เดียวกันกับใน Controller
                                    $reasonChoices = ['รักการทดลอง', 'ชอบเขียนโค้ด', 'มีคนแนะนำ', 'อื่นๆ']; 
                                @endphp

                                @foreach ($reasonChoices as $choice)
                                <label class="flex items-center text-gray-300">
                                    <input type="radio" name="reason_choice" value="{{ $choice }}" 
                                           x-model="reasonChoice" 
                                           class="mr-2 text-sta-yellow focus:ring-sta-yellow" 
                                           {{ old('reason_choice') == $choice ? 'checked' : '' }} required> 
                                    {{ $choice }}
                                </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('reason_choice')" class="mt-2" />
                        </div>

                        <div class="mb-6" x-show="reasonChoice === 'อื่นๆ'" x-transition>
                            <x-input-label for="reason_other" value="โปรดระบุเหตุผลอื่นๆ" class="text-gray-300" />
                            <textarea id="reason_other" name="reason_other" rows="3"
                                      class="block mt-1 w-full border-gray-500 bg-gray-600 text-white focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm"
                                      placeholder="ระบุเหตุผลของคุณ...">{{ old('reason_other') }}</textarea>
                            <x-input-error :messages="$errors->get('reason_other')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" 
                                    class="w-full px-4 py-2 bg-gradient-to-r from-yellow-400 via-sta-yellow to-yellow-500 text-black font-bold rounded-md hover:from-yellow-500 hover:to-yellow-600 focus:outline-none focus:ring-2 focus:ring-sta-yellow focus:ring-offset-2 focus:ring-offset-sta-dark">
                                ส่งข้อมูล (Submit)
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>