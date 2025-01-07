<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    private $pointsRequirements = [
        'motorik-1' => 0,      // First level is free
        'motorik-2' => 300,    // Need 300 points
        'motorik-3' => 600,    // Need 600 points
        'motorik-4' => 900,    // Need 900 points
    ];

    public function index()
    {
        $user = Auth::user();
        $userPoints = $user->points ?? 0; // Handle null points
        
        $games = [
            [
                'id' => 'motorik-1',
                'title' => 'Motorik I',
                'subtitle' => 'Tebak Warna',
                'icon' => 'Motorik1.png',
                'required_points' => $this->pointsRequirements['motorik-1'],
                'is_unlocked' => true
            ],
            [
                'id' => 'motorik-2',
                'title' => 'Motorik II',
                'subtitle' => 'Berhitung',
                'icon' => 'Motorik2.png',
                'required_points' => $this->pointsRequirements['motorik-2'],
                'is_unlocked' => $userPoints >= $this->pointsRequirements['motorik-2']
            ],
            [
                'id' => 'motorik-3',
                'title' => 'Motorik III',
                'subtitle' => 'Membaca',
                'icon' => 'Motorik3.png',
                'required_points' => $this->pointsRequirements['motorik-3'],
                'is_unlocked' => $userPoints >= $this->pointsRequirements['motorik-3']
            ],
            [
                'id' => 'motorik-4',
                'title' => 'Motorik IV',
                'subtitle' => 'Tebak Bentuk',
                'icon' => 'Motorik4.png',
                'required_points' => $this->pointsRequirements['motorik-4'],
                'is_unlocked' => $userPoints >= $this->pointsRequirements['motorik-4']
            ],
        ];
        
        return view('home_game', compact('games'));
    }

    private function validateAnswer($level, $answer)
    {
        $answers = [
            'motorik-1' => 'green', 
            'motorik-2' => '2',
            'motorik-3' => 'A',
            'motorik-4' => 'shape',
        ];
        return isset($answers[$level]) && $answers[$level] === $answer;
    }

    public function show($level){
        $user = Auth::user();
        $userPoints = $user->points ?? 0; // Handle null points
        
        // Check if user has enough points to access this level
        if ($userPoints < $this->pointsRequirements[$level]) {
            return redirect()->route('games.index')
                ->with('error', 'Kamu perlu ' . $this->pointsRequirements[$level] . ' poin untuk membuka level ini!');
        }

        $questionData = $this->getQuestionByLevel($level);
        if (is_array($questionData) && isset($questionData[0])) {
            $question = $questionData[0];
        } else {
            $question = $questionData;
        }
        return view('game', compact('question', 'level'));
    }

    public function checkAnswer(Request $request){
        $user = Auth::user();
        $isCorrect = $this->validateAnswer($request->level, $request->answer);
        
        if ($isCorrect) {
            $points = 100;
            $user->increment('points', $points);
            return response()->json([
                'status' => 'success',
                'message' => 'Selamat jawaban Kamu benar..',
                'points' => $points
            ]);
        }

        // Calculate new points but ensure it won't go below 0
        $points = -50;
        $newPoints = max(0, $user->points + $points);
        $user->update(['points' => $newPoints]);
        
        return response()->json([
            'status' => 'error',
            'message' => 'Sayang Sekali jawaban Kamu Salah..',
            'points' => $newPoints - $user->points // Show actual points deducted
        ]);
    }

    private function getQuestionByLevel($level){
        // Sample question data - in production, this would come from database
        $questions = [
            'motorik-1' => [
                [
                    'image' => '',
                    'question' => 'Mana balon yang berwarna hijau?',
                    'questionDesc' => '',
                    'options' => [
                        ['type' => 'image', 'value' => 'yellow', 'image' => 'Ballon_yellow.png'],
                        ['type' => 'image', 'value' => 'black', 'image' => 'Ballon_brown.png'],
                        ['type' => 'image', 'value' => 'green', 'image' => 'Ballon_green.png'],
                        ['type' => 'image', 'value' => 'blue', 'image' => 'Ballon_blue.png']
                    ],
                    'correct_answer' => 'green'
                ],
                [
                    'image' => '',
                    'question' => 'Mana balon yang berwarna Kuning?',
                    'questionDesc' => '',
                    'options' => [
                        ['type' => 'image', 'value' => 'yellow', 'image' => 'Ballon_yellow.png'],
                        ['type' => 'image', 'value' => 'black', 'image' => 'Ballon_brown.png'],
                        ['type' => 'image', 'value' => 'green', 'image' => 'Ballon_green.png'],
                        ['type' => 'image', 'value' => 'blue', 'image' => 'Ballon_blue.png']
                    ],
                    'correct_answer' => 'green'
                ]
            ],
            'motorik-2' => [
                'image' => '',
                'question' => 'Berapakah Jumlah 1 + 1 ?',
                'questionDesc' => '',
                'options' => [
                    ['type' => 'text', 'value' => '3'],
                    ['type' => 'text', 'value' => '2'],
                    ['type' => 'text', 'value' => '8'],
                    ['type' => 'text', 'value' => '10']
                ],
                'correct_answer' => '2'
            ],
            'motorik-3' => [
                'image' => '',
                'question' => 'M A K _ N. ',
                'questionDesc' => 'huruf apa yang hilang ?',
                'options' => [
                    ['type' => 'text', 'value' => 'C'],
                    ['type' => 'text', 'value' => 'K'],
                    ['type' => 'text', 'value' => 'I'],
                    ['type' => 'text', 'value' => 'A']
                ],
                'correct_answer' => 'A'
            ],
            'motorik-4' => [
                'image' => 'shapeQuest.png',
                'question' => '',
                'questionDesc' => 'Bentuk apakah gambar tersebut!',
                'options' => [
                    ['type' => 'image', 'value' => 'shape', 'image' => 'shape.png'],
                    ['type' => 'image', 'value' => 'ellipse', 'image' => 'ellipse.png'],
                    ['type' => 'image', 'value' => 'polygon', 'image' => 'polygon.png'],
                    ['type' => 'image', 'value' => 'star', 'image' => 'star.png']
                ],
                'correct_answer' => 'shape'
            ],
            // Add more questions for other levels
        ];

        return $questions[$level] ?? null;
    }
}