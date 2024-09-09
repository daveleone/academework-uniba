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
                        @lang('trad.Update')
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="flex justify-between items-center">
            <x-nav-link :href="route('student', $course->id)" class="px-4 py-2">
                @lang('trad.Add Students')
            </x-nav-link>

            <x-danger-button type="submit" class="bg-red-500 hover:bg-red-700" onclick="openModal()">
                @lang('trad.Delete Course')
            </x-danger-button>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Course</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        {{__('Are you sure you want to delete this course? This action cannot be undone.')}}
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="cancelBtn" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @lang('trad.Cancel')
                    </button>
                    <button id="deleteBtn" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        {{__('Delete')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="delete-course-form" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900"></h3>
                <div class="mt-2 px-7 py-3">
                    <p id="modalMessage" class="text-sm text-gray-500"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="cancelBtn" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @lang('trad.Cancel')
                    </button>
                    <button id="deleteBtn" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        @lang('trad.Cancel')
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="delete-course-form" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>


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
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="openModalStudent()">
                                {{__('Delete')}}
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="deleteModalStudent" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{__('Remove Student')}}</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        {{__('Are you sure you want to remove this student? This action cannot be undone.')}}
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="cancelBtnStudent" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        @lang('trad.Cancel')
                    </button>
                    <button id="deleteBtnStudent" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        {{__('Delete')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @foreach($course->students as $student)
        <form id="delete-student-form" action="{{ route('student.delete', ['course' => $course->id, 'student' => $student->id]) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach


    <script>
        function openModalStudent() {
            document.getElementById('deleteModalStudent').classList.remove('hidden');
        }

        function closeModalStudent() {
            document.getElementById('deleteModalStudent').classList.add('hidden');
        }

        document.getElementById('cancelBtnStudent').addEventListener('click', closeModalStudent);

        document.getElementById('deleteBtnStudent').addEventListener('click', function() {
            document.getElementById('delete-student-form').submit();
        });

        // Close the modal if clicked outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('deleteModalStudent');
            if (event.target == modal) {
                closeModalStudent();
            }
        }
    </script>

    <script>
        function openModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('cancelBtn').addEventListener('click', closeModal);

        document.getElementById('deleteBtn').addEventListener('click', function() {
            document.getElementById('delete-course-form').submit();
        });

        // Close the modal if clicked outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</x-app-layout>
