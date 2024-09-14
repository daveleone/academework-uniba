<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <a href="{{ route('courses.show') }}">
                    <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                </a>

                <h1 class="text-3xl font-bold text-gray-900">@lang('trad.Edit Course')</h1>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 transition duration-300 ease-in-out transform">
                <div class="p-6">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="course_description" />{{ __('trad.Course Name') }}</label>
                                <input type="text" name="course_name" id="course_name" value="{{ old('course_name', $course->course_name) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label for="course_description" />{{ __('trad.Course Description') }}</label>
                                <input type="text" name="course_description" id="course_description" value="{{ old('course_description', $course->course_description) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1">
                                <x-heroicon-s-pencil class="w-5 h-5 mr-2" />
                                @lang('trad.Update Course')
                            </button>

                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-course-deletion')"
                                class="hover:shadow-lg hover:-translate-y-1"
                            >
                                <x-heroicon-s-trash class="w-5 h-5 mr-2" />
                                @lang('trad.Delete Course')
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>




            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">

                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">@lang('trad.Enrolled Students')</h2>
                        @if($course->students->isNotEmpty())
                            <a href="{{ route('student', $course->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1">
                                <x-heroicon-s-user-plus class="w-5 h-5 mr-2" />
                                @lang('trad.Add Students')
                            </a>
                        @endif
                    </div>

                @if($course->students->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Name')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Surname')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Last Grade')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Average Grade')</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Actions')</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($course->students as $student)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('student.details', ['course' => $course->id, 'student' => $student->id]) }}" class="text-indigo-600 hover:text-indigo-900">{{ $student->user->name }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $student->user->surname }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $student->lastGradeForCourse($course->id)?->mark ?? __('trad.N A') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ round($student->averageGradeForCourse($course->id), 2) ?? __('trad.N A') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-danger-button
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-student-deletion-{{ $student->id }}')"
                                                class="hover:shadow-lg hover:-translate-y-1"
                                            >
                                                <x-heroicon-s-trash class="w-4 h-4" />
                                            </x-danger-button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <x-heroicon-o-users class="mx-auto h-12 w-12 text-gray-400" />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No students enrolled')</h3>
                            <p class="mt-1 text-sm text-gray-500">@lang('trad.Get started by adding a new student to this course')</p>
                            <div class="mt-6">
                                <a href="{{ route('student', $course->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-heroicon-s-user-plus class="-ml-1 mr-2 h-5 w-5" />
                                    @lang('trad.Add Student')
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('partials.class_modal_remove')

    @foreach ($course->students as $student)
        @include('partials.student_modal_remove')
    @endforeach
</x-app-layout>
