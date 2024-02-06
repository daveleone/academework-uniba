<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        <div class="mt-4 flex flex-row-reverse">
            <x-text-input id="search" placeholder="{{ __('Search...') }}" />
        </div>
    </div>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-x-auto id="userList"">
            <form action="{{ route('students.store', $course->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($students->count() > 0)
                <table class="table-auto w-full bg-white dark:bg-gray-700 shadow-lg mb-4 rounded-md border-separate">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-white">
                            <th class="px-4 py-2 text-left">{{ __('ID')}}</th>
                            <th class="px-4 py-2 text-left">{{ __('Name')}}</th>
                            <th class="px-4 py-2 text-left">{{ __('E-mail')}}</th>
                            <th class="px-4 py-2 text-left">{{ __('Add Student')}}</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-white">
                        @foreach ($students as $student)
                        <tr class="border-b border-gray-200 dark:border-gray-600">
                            <td class="px-4 py-2 text-left">{{ $student->id }}</td>
                            <td class="px-4 py-2 text-left">{{ $student->user->name }}</td>
                            <td class="px-4 py-2 text-left">{{ $student->user->email }}</td>
                            <td class="px-4 py-2 text-left">
                                <input type="checkbox" name="selected_students[]" value="{{ $student->id }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                    Save Selected Students
                </button>
            </form>
        </div>
        {{ $students->links() }}
    </main>
    @else
    <div class="bg-white dark:bg-gray-800 overflow-hidden max-w-7xl mx-auto shadow-sm sm:rounded-lg p-6 sm:px-6 lg:px-8 mt-4">
        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{__('Seems like there arent any students to be added to your class!')}}</p>
    </div>
    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 shadow-sm">
        <x-nav-link :href="route('courses.edit', $course->id)">
            {{__('Go back to view the class')}}
        </x-nav-link>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();
            console.log(query);
            $.ajax({
                url: "{{ route('students.search', $course->id) }}",
                type: "GET",
                data: {
                    'query': query
                },
                success: function (data) {
                    $('#userList').html(data); // Update the HTML content with the search results
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

