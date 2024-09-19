@php
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $student = \App\Models\Student::where('user_id', $user_id)->get()->first();
@endphp

@if(!empty($quizzes))
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto mx-auto">
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
                    @foreach ($quizzes as $quizMark)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quizMark->quiz->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($quizMark->mark !== null)
                                    {{ number_format($quizMark->mark, 2, '.', '') }}
                                @else
                                    @lang('trad.N/A')
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($quizMark->created_at)
                                    {{$quizMark->created_at->format('d M Y H:i')}}
                                @else
                                    @lang('trad.N/A')
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('student.reviewVote', ['course' => $course->id, 'student' => $student->id, 'quiz' => $quizMark->quiz->id]) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
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
    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>
@else
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <p class="text-gray-700">@lang('trad.No quizzes found in this category.')</p>
        </div>
    </div>
@endif
