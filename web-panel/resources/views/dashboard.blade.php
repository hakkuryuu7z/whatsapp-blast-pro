@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-50 border border-blue-100 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 rounded-full text-white">
                    <i class="fa-solid fa-mobile-screen-button text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Perangkat</p>
                    <p class="text-lg font-semibold text-gray-700">1 <span class="text-xs font-normal text-green-500 ml-2">Connected</span></p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-100 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 rounded-full text-white">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Kontak</p>
                    <p class="text-lg font-semibold text-gray-700">0</p>
                </div>
            </div>
        </div>
        
        <div class="bg-purple-50 border border-purple-100 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-500 rounded-full text-white">
                    <i class="fa-solid fa-paper-plane text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Pesan Terkirim</p>
                    <p class="text-lg font-semibold text-gray-700">0</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 border border-gray-100 rounded-lg p-6 flex flex-col items-center justify-center h-64">
        <i class="fa-solid fa-chart-line text-4xl text-gray-300 mb-4"></i>
        <p class="text-gray-500 font-medium">Belum ada aktivitas Blast hari ini.</p>
    </div>
@endsection