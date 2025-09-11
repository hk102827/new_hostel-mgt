<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class NavigationServiceProvider extends ServiceProvider
{
       public function boot()
    {
        // Multiple views ke liye composer setup karo
        View::composer(['layouts.admin', 'layouts.app', 'layouts.*'], function ($view) {
            $user = Auth::user();
            $navigationItems = [];

            if ($user) {
                // Dashboard - sabko accessible
                $navigationItems['dashboard'] = [
                    'route' => 'admin.dashboard',
                    'icon' => 'fas fa-home',
                    'label' => 'Dashboard',
                    'active' => 'admin.dashboard'
                ];

                // Students Management
                if ($user->can('students.view') || $user->can('students.manage')) {
                    $navigationItems['students'] = [
                        'route' => 'admin.students.index',
                        'icon' => 'fas fa-users',
                        'label' => 'Hostel Students',
                        'active' => 'admin.students.*'
                    ];
                }

                // Room Management - Super Admin & Admin only
                if ($user->can('rooms.view') || $user->can('rooms.manage')) {
                    $navigationItems['rooms'] = [
                        'route' => 'admin.rooms.index',
                        'icon' => 'fas fa-bed',
                        'label' => 'Room Management',
                        'active' => 'admin.rooms.*'
                    ];
                }

                // Academy Management
                if ($user->can('academy.view') || $user->can('academy.manage')) {
                    $navigationItems['academy'] = [
                        'route' => 'admin.academy.index',
                        'icon' => 'fas fa-book',
                        'label' => 'Japanese Academy',
                        'active' => 'admin.academy.*'
                    ];
                }

                // Mess Management
                if ($user->can('mess.view') || $user->can('mess.manage')) {
                    $navigationItems['mess'] = [
                        'route' => 'admin.mess.index',
                        'icon' => 'fas fa-utensils',
                        'label' => 'Mess Management',
                        'active' => 'admin.mess.*'
                    ];
                }

                // Kitchen Management - Super Admin & Admin only
                if ($user->can('kitchen.view') || $user->can('kitchen.manage')) {
                    $navigationItems['kitchen'] = [
                        'route' => 'admin.kitchen.index',
                        'icon' => 'fas fa-carrot',
                        'label' => 'Kitchen Management',
                        'active' => 'admin.kitchen.*'
                    ];
                }

                // Fee Management
                if ($user->can('fees.view') || $user->can('fees.manage')) {
                    $navigationItems['fees'] = [
                        'route' => 'admin.fees.index',
                        'icon' => 'fas fa-money-bill',
                        'label' => 'Fee Management',
                        'active' => 'admin.fees.*'
                    ];
                }

                // Teachers Management - Super Admin only
                if ($user->can('teachers.view') || $user->can('teachers.manage')) {
                    $navigationItems['teachers'] = [
                        'route' => 'admin.teachers.index',
                        'icon' => 'fas fa-chalkboard-teacher',
                        'label' => 'Teachers',
                        'active' => 'admin.teachers.*'
                    ];
                }

                // Reports
                if ($user->can('reports.view') || $user->can('reports.manage')) {
                    $navigationItems['reports'] = [
                        'route' => 'admin.reports.index',
                        'icon' => 'fas fa-chart-bar',
                        'label' => 'Reports',
                        'active' => 'admin.reports.*'
                    ];
                }

                // Attendance Section
                $attendanceItems = [];
                
                if ($user->can('attendance.mark')) {
                    $attendanceItems['mark'] = [
                        'route' => 'admin.attendance.create',
                        'icon' => 'fas fa-check-circle',
                        'label' => 'Mark Attendance',
                        'active' => 'admin.attendance.create'
                    ];
                }

                if ($user->can('attendance.daily')) {
                    $attendanceItems['daily'] = [
                        'route' => 'admin.attendance.daily',
                        'icon' => 'fas fa-calendar-day',
                        'label' => 'Daily Attendance',
                        'active' => 'admin.attendance.daily'
                    ];
                }

                if ($user->can('attendance.monthly')) {
                    $attendanceItems['monthly'] = [
                        'route' => 'admin.attendance.monthly',
                        'icon' => 'fas fa-calendar-alt',
                        'label' => 'Monthly Attendance',
                        'active' => 'admin.attendance.monthly'
                    ];
                }

                $navigationItems['attendance'] = $attendanceItems;
            }

            $view->with('navigationItems', $navigationItems);
        });
    }
}