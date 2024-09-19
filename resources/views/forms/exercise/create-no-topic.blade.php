<!-- Modal toggle -->
<button
    data-modal-target="CreateEx-modal"
    data-modal-toggle="CreateEx-modal"
    class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1"
    type="button">
    <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    @lang('trad.Add exercise')
</button>

<!-- Main modal -->
<div
    id="CreateEx-modal"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative max-h-full w-full max-w-md">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700 rounded-t-2xl rounded-b-2xl">
            <!-- Modal header -->
            <div class="px-8 py-6 bg-indigo-600 rounded-t-2xl">
                <h2 class="text-2xl font-bold text-white text-center">
                    @lang('trad.Create New Exercise')
                </h2>
            </div>

            <!-- Modal body -->
            <form
                id="CreateEx"
                action="{{ route("exercise.createInit") }}"
                method="post"
                class="p-4 md:p-5">
                @method("post")
                @csrf
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        @include('forms.exercise.search_topics')
                    </div>
                    <div class="col-span-2">
                        <label
                            for="ExName"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            @lang('trad.Exercise name')
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-heroicon-o-book-open class="w-5 h-5 text-gray-400" />
                            </div>
                            <input type="text" name="ExName" id="ExName" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="@lang('trad.Type exercise name')" required value="{{ old('ExName' )}}">
                        </div>
                        @error('ExName')
                            <div class="text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label
                            for="ExDescription"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            @lang('trad.Exercise\'s Description')
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex pointer-events-none pt-2">
                                <x-heroicon-o-document-text class="w-5 h-5 text-gray-400" />
                            </div>
                            <textarea id="ExDescription" name="ExDescription" rows="4" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="@lang('trad.Write exercise description here')" required>{{ old('ExDescription')}}</textarea>
                        </div>
                        @error('ExDescription')
                            <div class="text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="ExPoints"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            @lang('trad.Exercise points')
                        </label>
                        <input
                            type="number"
                            id="ExPoints"
                            name="ExPoints"
                            min="1"
                            required
                            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="{{__('')}}"
                            required
                            value="{{ old('ExPoints' )}}"/>
                        @error('ExPoints')
                            <div class="text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="ExType"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            @lang('trad.Select the type')
                        </label>
                        <select
                            form="CreateEx"
                            required
                            id="ExType"
                            name="ExType"
                            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            <option value="true/false">@lang('trad.True or false')</option>
                            <option value="open">@lang('trad.Open question')</option>
                            <option value="close">@lang('trad.Closed question')</option>
                            <option value="fill-in">@lang('trad.Fill in text')</option>
                        </select>
                        @error('ExType')
                            <div class="text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-between space-x-4">
                    <button
                        type="submit" class="group w-1/2 inline-flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1"
                        @if($topics->count() == 0)
                            disabled
                        @endif
                    >
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-plus-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Add exercise')
                    </button>
                    <a class="group w-1/2 flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1"
                    data-modal-toggle="CreateEx-modal">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-x-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Cancel')
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
