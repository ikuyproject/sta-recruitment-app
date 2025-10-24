<x-admin.layout>
    <x-slot name="header">
        Dashboard (ภาพรวมระบบ)
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-1">ใบสมัครทั้งหมด</h3>
            <p class="text-4xl font-bold">{{ number_format($totalApplications) }}</p>
            <p class="text-sm opacity-80 mt-2">จำนวนใบสมัครที่ส่งเข้าระบบ</p>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-1">รอตรวจสอบ</h3>
            <p class="text-4xl font-bold">{{ number_format($pendingApplications) }}</p>
            <p class="text-sm opacity-80 mt-2">ใบสมัครที่ยังรอการอนุมัติ</p>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-1">ผู้กรอกฟอร์มความสนใจ</h3>
            <p class="text-4xl font-bold">{{ number_format($totalInterestForms) }}</p>
            <p class="text-sm opacity-80 mt-2">จำนวนผู้แสดงความสนใจในสาขา</p>
        </div>

        {{--
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-1">ยอดเข้าชม (ตัวอย่าง)</h3>
            <p class="text-4xl font-bold">1,234</p>
             <p class="text-sm opacity-80 mt-2">จำนวนครั้งที่เข้าชมเว็บไซต์ (วันนี้)</p>
        </div>
        --}}
    </div>

    <hr class="my-6 border-gray-300">

    <h2 class="text-2xl font-semibold mb-4 text-gray-800">สรุปข้อมูลความสนใจ (แบ่งตามสาขา)</h2>
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-center">สัดส่วนความสนใจ</h3>
            <canvas id="interestDonutChart" style="max-height: 400px;"></canvas>
        </div>

        <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-center">จำนวนผู้สนใจ</h3>
            <canvas id="interestBarChart" style="max-height: 400px;"></canvas>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            import Chart from 'chart.js/auto';

            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);
            const chartColors = @json($chartColors);

            // Donut Chart
            const ctxDonut = document.getElementById('interestDonutChart');
            if (ctxDonut) {
                new Chart(ctxDonut.getContext('2d'), {
                    type: 'doughnut',
                    data: { labels: chartLabels, datasets: [{ label: 'จำนวนผู้สนใจ', data: chartData, backgroundColor: chartColors, borderColor: chartColors, borderWidth: 1 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right', } } } // เปลี่ยน legend ไปด้านขวา
                });
            }

            // Bar Chart
            const ctxBar = document.getElementById('interestBarChart');
             if (ctxBar) {
                new Chart(ctxBar.getContext('2d'), {
                    type: 'bar',
                    data: { labels: chartLabels, datasets: [{ label: 'จำนวนผู้สนใจ', data: chartData, backgroundColor: chartColors, borderColor: chartColors, borderWidth: 1 }] },
                    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
                });
            }
        </script>
    @endpush

</x-admin.layout>