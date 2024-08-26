<x-app-layout>
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-2">
                        <x-input-label for="course_name" :value="__('Course Name')" />
                        <!-- <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $course->course_name }}</p> -->
                        <x-text-input id="course_name" class="block mt-1 " type="text" name="course_name" value="{{ $course->course_name }}" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <x-input-label for="course_description" :value="__('Course Description')" />
                        <!-- <p class="text-gray-700 dark:text-gray-200">{{ $course->course_description }}</p> -->
                        <x-text-input id="course_description" class="block mt-1 " type="text" name="course_description" value="{{ $course->course_description }}" />
                    </div>
                    <div class="col-span-6 sm:col-span-2 justify-self-end">

                        <x-primary-button class="mt-8">
                            {{__('Update')}}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <x-nav-link :href="route('student', $course->id)">
            Add Students
        </x-nav-link>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{__('Name')}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{__('Surname')}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{__('Last Grade')}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{__('Average Grade')}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{__('Actions')}}
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200">
                @foreach ($course->students as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            {{ $student->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            TEST
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            TEST
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            TEST
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            <form action="{{ route('student.delete', ['course' => $course->id, 'student' => $student->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    {{__('Delete')}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
