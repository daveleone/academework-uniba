                <table class="table-auto w-full bg-white dark:bg-gray-700 shadow-lg mb-4 rounded-md border-separate" id="userList">
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
