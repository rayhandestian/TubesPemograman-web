<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all(); // Mengambil semua soal dari database
        return view('parent.manage', compact('questions'));
    }

    // Menampilkan form untuk membuat soal baru
    public function create()
    {
        return view('parent.create');
    }

    // Menyimpan soal yang baru dibuat
    public function store(Request $request)
    {
        $data = $request->validate([
            'level' => 'required|string',
            'question' => 'required|string',
            'question_desc' => 'nullable|string',
            'image' => 'nullable|image|max:1024', // Validasi gambar jika ada
        ]);

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('questions'); // Menyimpan gambar
        }

        $question = Question::create($data);

        return redirect()->route('parent.manage')->with('success', 'Soal berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit soal
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('parent.edit', compact('question'));
    }

    // Mengupdate soal yang diedit
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'level' => 'required|string',
            'question' => 'required|string',
            'question_desc' => 'nullable|string',
            'image' => 'nullable|image|max:1024', // Validasi gambar jika ada
        ]);

        $question = Question::findOrFail($id);

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('questions');
        }

        $question->update($data);

        return redirect()->route('parent.manage')->with('success', 'Soal berhasil diupdate!');
    }

    // Menghapus soal
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->options()->delete(); // Menghapus opsi yang terkait
        $question->delete(); // Menghapus soal
        return redirect()->route('parent.manage')->with('success', 'Soal berhasil dihapus!');
    }
}
