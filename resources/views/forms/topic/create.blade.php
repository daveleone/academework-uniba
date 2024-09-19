<!-- Modal toggle -->
<button data-modal-target="CreateTop-modal" data-modal-toggle="CreateTop-modal" class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1" dusk="add-topic-button">
    <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    @lang('trad.Add topic')
</button>

<!-- Main modal -->
<div id="CreateTop-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 rounded-t-2xl rounded-b-2xl">
            <!-- Modal header -->
            <div class="px-8 py-6 bg-indigo-600 rounded-t-2xl">
                <h2 class="text-2xl font-bold text-white text-center">
                    @lang('trad.Create New Topic')
                </h3>
            </div>
            <!-- Modal body -->
            <form action="{{ route('topic.create', ['id' => $subject->id]) }}" method="post" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="TopicName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Topic's name</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-heroicon-o-book-open class="w-5 h-5 text-gray-400" />
                            </div>
                            <input type="text" name="TopicName" id="TopicName" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Type topic's name" required dusk="create-topic-name">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="TopicDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Topic's Description</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex pointer-events-none pt-2">
                                <x-heroicon-o-document-text class="w-5 h-5 text-gray-400" />
                            </div>
                            <textarea id="TopicDescription" name="TopicDescription" rows="4" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Write topic's description here" required dusk="create-topic-description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between space-x-4">
                    <button type="submit" class="group w-1/2 inline-flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1" dusk="submit-create-topic">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-plus-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Add topic')
                    </button>
                    <a class="group w-1/2 flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1"
                    data-modal-toggle="CreateTop-modal">
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
