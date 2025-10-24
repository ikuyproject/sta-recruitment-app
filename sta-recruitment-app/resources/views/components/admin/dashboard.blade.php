<x-admin.layout>

    <x-slot name="header">
        สรุปข้อมูลความสนใจ (Interest Form)
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">สัดส่วนความสนใจ (Donut Chart)</h3>
            <canvas id="interestDonutChart" style="max-height: 400px;"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">จำนวนผู้สนใจ (Bar Chart)</h3>
            <canvas id="interestBarChart" style="max-height: 400px;"></canvas>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            import Chart from 'https://cdn.jsdelivr.net/npm/chart.js';

            const chartData = @json($interestData);
            const labels = chartData.map(item => item.program_name);
            const data = chartData.map(item => item.total);
            const backgroundColors = data.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.7)`);
            const borderColors = backgroundColors.map(color => color.replace('0.7', '1'));

            // Donut Chart
            const ctxDonut = document.getElementById('interestDonutChart').getContext('2d');
            new Chart(ctxDonut, {
                type: 'doughnut',
                data: { labels: labels, datasets: [{ label: 'จำนวนผู้สนใจ', data: data, backgroundColor: backgroundColors, borderColor: borderColors }] },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Bar Chart
            const ctxBar = document.getElementById('interestBarChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: { labels: labels, datasets: [{ label: 'จำนวนผู้สนใจ', data: data, backgroundColor: backgroundColors, borderColor: borderColors }] },
                options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
            });
        </script>
    @endpush

</x-admin.layout>