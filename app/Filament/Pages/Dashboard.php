<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    public function getHeading(): string
    {
        return $this->getGreeting();
    }

    protected function getGreeting(): string
    {
        $hour = now()->hour;
        $userName = Auth::user()->name;

        // Determine greeting based on time of day
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        return "{$greeting}, {$userName}";
    }
}
