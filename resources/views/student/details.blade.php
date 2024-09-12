<x-app-layout>
    <div class="min-h-screen bg-gray-100 from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-900 flex items-center">
                            <x-heroicon-o-user-circle class="w-8 h-8 mr-2 text-indigo-600" />
                            @lang('trad.Student Details')
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">@lang('trad.Name')</p>
                                <p class="mt-1 text-lg text-gray-900">{{ $student->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">@lang('trad.Email')</p>
                                <p class="mt-1 text-lg text-gray-900">{{ $student->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">@lang('trad.Average Grade')</p>
                                <p class="mt-1 text-lg text-gray-900">{{ number_format($averageGrade, 2, '.', '') }}</p>
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold mt-8 mb-4 text-gray-900 flex items-center">
                            <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2 text-indigo-600" />
                            @lang('trad.Quiz History')
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Quiz Name')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Grade')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Date')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Actions')</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($quizzes as $quiz)
                                    @php
                                        $mark = $marks->firstWhere('quiz_id', $quiz->id);
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mark ? number_format($mark->mark, 2, '.', '') : __('trad.N/A') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mark ? $mark->created_at->format('Y-m-d H:i') : __('trad.N/A') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('student.changeVote', ['course' => $course->id, 'student' => $student->id, 'quiz' => $quiz->id]) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                                                @lang('trad.Review')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
