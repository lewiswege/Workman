<?php

namespace App\Filament\Widgets;

use App\Models\Installations;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CompletedInstallationsChart extends ChartWidget
{
    protected ?string $heading = 'Completed Installations (Last 30 Days)';

    protected function getData(): array
    {
        // Get the last 30 days of data
        $startDate = now()->subDays(29)->startOfDay();
        $endDate = now()->endOfDay();

        // Get completed installations grouped by day
        $completedByDay = Installations::query()
            ->where('status', 'completed')
            ->whereNotNull('completed_at')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(completed_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Generate labels and data for the last 30 days
        $labels = [];
        $data = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateKey = $date->format('Y-m-d');
            $labels[] = $date->format('M j'); // e.g., "Jan 3"
            $data[] = $completedByDay[$dateKey] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Installations Completed',
                    'data' => $data,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected static ?int $sort = 1;

    protected function getType(): string
    {
        return 'line';
    }
}
