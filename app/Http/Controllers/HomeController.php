<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Definisikan variabel $games
        $games = [
            [
                'id' => 'motorik-1',
                'title' => 'Motorik I',
                'subtitle' => 'Tebak Warna',
                'icon' => 'Motorik1.png'
            ],
            [
                'id' => 'motorik-2',
                'title' => 'Motorik II',
                'subtitle' => 'Berhitung',
                'icon' => 'Motorik2.png'
            ],
            [
                'id' => 'motorik-3',
                'title' => 'Motorik III',
                'subtitle' => 'Membaca',
                'icon' => 'Motorik3.png'
            ],
            [
                'id' => 'motorik-4',
                'title' => 'Motorik IV',
                'subtitle' => 'Tebak Bentuk',
                'icon' => 'Motorik4.png'
            ],
        ];

        return view('home_game', compact('games', 'user'));
    }
    
}
