<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // SENIN
            ['subject' => 'Praktikum Algoritma Pemrograman', 'class' => 'A', 'day' => 'Senin', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Desain UI/UX', 'class' => 'D', 'day' => 'Senin', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Data Warehouse dan BI', 'class' => 'B', 'day' => 'Senin', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum Data Warehouse dan BI', 'class' => 'C', 'day' => 'Senin', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum Software Testing dan Quality Assurance', 'class' => 'A', 'day' => 'Senin', 'start_time' => '12:50', 'end_time' => '15:20', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum Software Testing dan Quality Assurance', 'class' => 'B', 'day' => 'Senin', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 403'],

            // SELASA
            ['subject' => 'Praktikum Algoritma Pemrograman', 'class' => 'D', 'day' => 'Selasa', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Data Warehouse dan BI', 'class' => 'E', 'day' => 'Selasa', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum Keamanan Data & Informasi', 'class' => 'A', 'day' => 'Selasa', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 401'],

            // RABU
            ['subject' => 'Praktikum Algoritma Pemrograman', 'class' => 'B', 'day' => 'Rabu', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Desain UI/UX', 'class' => 'E', 'day' => 'Rabu', 'start_time' => '12:50', 'end_time' => '15:20', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Data Warehouse dan BI', 'class' => 'D', 'day' => 'Rabu', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 401'],
            ['subject' => 'Praktikum Keamanan Data & Informasi', 'class' => 'B', 'day' => 'Rabu', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Keamanan Data & Informasi', 'class' => 'E', 'day' => 'Rabu', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum pemrograman WEB', 'class' => 'B', 'day' => 'Rabu', 'start_time' => '12:50', 'end_time' => '15:20', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum pemrograman WEB', 'class' => 'C', 'day' => 'Rabu', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum pemrograman WEB', 'class' => 'D', 'day' => 'Rabu', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 401'],
            ['subject' => 'Praktikum pemrograman Mobile', 'class' => 'A', 'day' => 'Rabu', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum Software Testing dan Quality Assurance', 'class' => 'C', 'day' => 'Rabu', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 401'],

            // KAMIS
            ['subject' => 'Praktikum Algoritma Pemrograman', 'class' => 'C', 'day' => 'Kamis', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Desain UI/UX', 'class' => 'C', 'day' => 'Kamis', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Keamanan Data & Informasi', 'class' => 'D', 'day' => 'Kamis', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 401'],

            // JUMAT
            ['subject' => 'Praktikum Algoritma Pemrograman', 'class' => 'E', 'day' => 'Jumat', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Desain UI/UX', 'class' => 'A', 'day' => 'Jumat', 'start_time' => '15:25', 'end_time' => '17:05', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum Desain UI/UX', 'class' => 'B', 'day' => 'Jumat', 'start_time' => '09:50', 'end_time' => '11:30', 'room' => 'Lab 401'],
            ['subject' => 'Praktikum Data Warehouse dan BI', 'class' => 'A', 'day' => 'Jumat', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 403'],
            ['subject' => 'Praktikum Keamanan Data & Informasi', 'class' => 'C', 'day' => 'Jumat', 'start_time' => '08:00', 'end_time' => '09:40', 'room' => 'Lab 401'],
            ['subject' => 'Praktikum pemrograman WEB', 'class' => 'A', 'day' => 'Jumat', 'start_time' => '13:10', 'end_time' => '15:20', 'room' => 'Lab 402'],
            ['subject' => 'Praktikum pemrograman WEB', 'class' => 'E', 'day' => 'Jumat', 'start_time' => '13:10', 'end_time' => '15:20', 'room' => 'Lab 401'],
        ];

        foreach ($data as $item) {
            Schedule::create($item);
        }
    }
}