<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Student's Details</h2>
            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">Name:</strong> {{ $student->user->name }}</p>
            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">Email:</strong> {{ $student->user->email }}</p>
            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">Average Grade:</strong> {{ number_format($averageGrade, 2, '.', '') }}</p>

            <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-900 dark:text-white">@lang('trad.Quiz History')</h3>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quiz Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($quizzes as $quiz)
                    @php
                        $mark = $marks->firstWhere('quiz_id', $quiz->id);
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">{{ $quiz->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">{{ $mark ? number_format($mark->mark, 2, '.', '') : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">{{ $mark ? $mark->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                            <a href="{{route('student.changeVote', ['course' => $course->id, 'student' => $student->id, 'quiz' => $quiz->id])}}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">Review</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
