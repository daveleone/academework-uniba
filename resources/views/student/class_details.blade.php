<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">{{ $course->name }} Details</h2>
            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">Teacher:</strong> {{ $teacher->name }}</p>
            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">Average Grade (Non-repeatable Quizzes):</strong> {{ number_format($averageGrade, 2, '.', '') }}</p>

            <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-900 dark:text-white">Non-Repeatable Quiz Grades</h3>
            @include('student.partials.details_table', ['quizzes' => $nonRepeatableQuizzes])

            <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-900 dark:text-white">Repeatable Quiz Grades</h3>
            @include('student.partials.details_table', ['quizzes' => $repeatableQuizzes])
        </div>
    </div>
</x-app-layout>
