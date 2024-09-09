<!-- Main modal -->
<div id="EditSub-modal-{{ $subject->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    @lang('trad.Edit') 
                    {{ $subject->name }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="EditSub-modal-{{ $subject->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">{{__('Close modal')}}</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('subject.edit') }}" method="post" id="CreateSub" class="p-4 md:p-5">
                @method('PUT ')
                @csrf
                <input type="hidden" name="subId" value="{{ $subject->id }}">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="{{ 'subName'.$subject->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('trad.Subject\'s name')</label>
                        <input type="text" name="{{ 'subName'.$subject->id }}" id="{{ 'subName'.$subject->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="{{ $subject->name }}">
                    </div>
                    <div class="col-span-2">
                        <label for="{{ 'subDesc'.$subject->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('trad.Subject\'s Description')</label>
                        <textarea id="{{ 'subDesc'.$subject->id }}" name="{{ 'subDesc'.$subject->id }}" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $subject->description }}"></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                @lang('trad.Edit subject')
                </button>
                <button type="reset" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-toggle="EditSub-modal-{{ $subject->id }}">@lang('trad.Abort')</button>
            </form>
        </div>
    </div>
</div>
