<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($question) ? 'Edit Question' : 'Create Question' }} - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-xl font-semibold">{{ isset($question) ? 'Edit Question' : 'Create Question' }}</span>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ isset($question) ? route('admin.questions.update', $question->id) : route('admin.questions.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($question))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="level" class="block text-gray-700 text-sm font-bold mb-2">Level</label>
                        <input type="text" 
                               name="level" 
                               id="level" 
                               value="{{ old('level', $question->level ?? '') }}" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Question</label>
                        <textarea name="question" 
                                  id="question" 
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  rows="3" 
                                  required>{{ old('question', $question->question ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="question_desc" class="block text-gray-700 text-sm font-bold mb-2">Description (Optional)</label>
                        <textarea name="question_desc" 
                                  id="question_desc" 
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  rows="3">{{ old('question_desc', $question->question_desc ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image (Optional)</label>
                        <input type="file" 
                               name="image" 
                               id="image" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               accept="image/*">
                        @if(isset($question) && $question->image)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Current Image:</p>
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Current Question Image" class="mt-1 h-20 w-20 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ isset($question) ? 'Update Question' : 'Create Question' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 