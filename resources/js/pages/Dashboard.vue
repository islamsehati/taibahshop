<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const page = usePage();
const user = page.props.auth.user;
const stats = page.props.dashboardStats ?? {
    orderCount: 0,
    orderCountNominal: 0,
    orderPending: 0,
    orderPendingNominal: 0,
    orderPaid: 0,
    orderPaidNominal: 0,
};
const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard().url },
];

const chartData = page.props.chartData || [];
const lineChart = ref<HTMLCanvasElement>();
onMounted(() => {
    if (!lineChart.value) return;

    const labels = chartData.map(d => {
        const date = new Date(d.date);
        return date.getDate() + ' ' + date.toLocaleString('id-ID', { month: 'short' });
    });

    const orderData = chartData.map(d => d.order_total);
    const paymentData = chartData.map(d => d.payment_total);

    new Chart(lineChart.value, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Grand Total (Order)',
                    data: orderData,
                    borderColor: '#F59E0B',
                    backgroundColor: 'rgba(245, 158, 11, 0.2)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Nominal (Payment)',
                    data: paymentData,
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(0, 0, 255, 0.3)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return value.toLocaleString(); }
                    }
                }
            }
        }
    });
});
</script>


<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 rounded-xl p-3"
        >
        <div class="grid auto-rows-min gap-4 md:grid-cols-3"
            v-if="user?.is_admin"
            >
            <div
                class="relative aspect-video rounded-xl bg-background/50 backdrop-blur-lg border border-sidebar-border/70 dark:border-sidebar-border p-6 flex flex-col justify-center"
            > <h2 class="absolute right-4 text-3xl font-bold">🚀</h2>
                <p class="text-gray-500 dark:text-gray-300">Total Order</p>
                <h1 class="text-4xl font-bold">{{ Number(stats.orderCount).toLocaleString() }}</h1>
                <h1 class="text-xl font-bold">{{ Number(stats.orderCountNominal).toLocaleString() }}</h1>
            </div>

            <div
                class="relative aspect-video rounded-xl bg-background/50 backdrop-blur-lg border border-sidebar-border/70 dark:border-sidebar-border p-6 flex flex-col justify-center"
            > <h2 class="absolute right-4 text-3xl font-bold">⏳</h2>
                <p class="text-gray-500 dark:text-gray-300">Pending</p>
                <h1 class="text-4xl font-bold">{{ stats.orderPending }}</h1>
                <h1 class="text-xl font-bold">{{ Number(stats.orderPendingNominal).toLocaleString() }}</h1>
            </div>

            <div
                class="relative aspect-video rounded-xl bg-background/50 backdrop-blur-lg border border-sidebar-border/70 dark:border-sidebar-border p-6 flex flex-col justify-center"
            > <h2 class="absolute right-4 text-3xl font-bold">💰</h2>
                <p class="text-gray-500 dark:text-gray-300">Paid</p>
                <h1 class="text-4xl font-bold">{{ Number(stats.orderPaid).toLocaleString() }}</h1>
                <h1 class="text-xl font-bold">{{ Number(stats.orderPaidNominal).toLocaleString() }}</h1>
            </div>
        </div>

        <div
            class="min-h-[100vh] flex-1 rounded-xl bg-background/50 backdrop-blur-lg border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border p-6"
        >
            <p class="text-gray-500 dark:text-gray-300">Halo {{ user.name }}</p>
            <h2 class="text-3xl font-bold">Selamat Datang 🎉</h2>
            <div v-if="user?.is_admin" class="mt-6">
                <div class="relative w-full h-[260px] sm:h-[320px] md:h-auto">
                    <canvas ref="lineChart"></canvas>
                </div>
            </div>
        </div>

        </div>
    </AppLayout>
</template>
