<x-app-layout>
    <div class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto"> <!-- Modificato per centrare e limitare la larghezza -->
            <div class="mb-8 inline-flex items-center">
                <a href="{{ route('courses.edit', $course->id) }}">
                    <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                </a>
                <h1 class="text-3xl font-bold text-gray-900">@lang('trad.Student Details')</h1>
            </div>
            <div class="bg-indigo-600 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6 pb-6 text-center"> <!-- Aggiunto text-center -->
                <div>
                    <p class="text-sm font-medium text-white">@lang('trad.Name')</p>
                    <p class="mt-1 text-lg text-white">{{ $student->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-white">@lang('trad.Surname')</p>
                    <p class="mt-1 text-lg text-white">{{ $student->user->surname }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-white">@lang('trad.Email')</p>
                    <p class="mt-1 text-lg text-white">{{ $student->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-white">@lang('trad.Average Grade')</p>
                    <p class="mt-1 text-lg text-white">{{ number_format($averageGrade, 2, '.', '') }}</p>
                </div>
            </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Centrato il contenuto dei dettagli dello studente -->


                    <!-- Centrato il titolo e la tabella -->
                    <h3 class="text-xl font-semibold mt-8 mb-4 text-gray-900 flex">
                        <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2 text-indigo-600" />
                        @lang('trad.Quiz History')
                    </h3>
                    <div class="overflow-x-auto mx-auto"> <!-- Aggiunto mx-auto per centrare -->
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
                                @if(isset($mark))
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
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
