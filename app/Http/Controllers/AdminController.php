<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($request->username === 'admin' && $request->password === 'admin123') {
            $user = Auth::user();
            if ($user) {
                Auth::logout();
            }
            
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }
        
        $questions = Question::all();
        return view('admin.dashboard', compact('questions'));
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }

    // Questions Management Methods
    public function createQuestion()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }
        return view('admin.questions.form');
    }

    public function storeQuestion(Request $request)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'level' => 'required|string|max:255',
            'question' => 'required|string',
            'question_desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('questions', 'public');
            $validated['image'] = $path;
        }

        Question::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Question created successfully');
    }

    public function editQuestion(Question $question)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }
        return view('admin.questions.form', compact('question'));
    }

    public function updateQuestion(Request $request, Question $question)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'level' => 'required|string|max:255',
            'question' => 'required|string',
            'question_desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }
            $path = $request->file('image')->store('questions', 'public');
            $validated['image'] = $path;
        }

        $question->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Question updated successfully');
    }

    public function destroyQuestion(Question $question)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        if ($question->image) {
            Storage::disk('public')->delete($question->image);
        }
        
        $question->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Question deleted successfully');
    }
} 