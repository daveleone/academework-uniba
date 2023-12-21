<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subjects') }}
        </h2>
    </x-slot>

    <div>
        <div style="background-color: white; padding: 5rem;">
            
        <form class="form-horizontal">
        <fieldset>
            <!-- Form Name -->
            <legend>Form Name</legend>
            
            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="Name">Subject</label>  
            <div class="col-md-4">
            <input id="Name" name="Name" type="text" placeholder="" class="form-control input-md" required="">
                
            </div>
            </div>
            
            <!-- Textarea -->
            <div class="form-group">
            <label class="col-md-4 control-label" for="description">Subject's description</label>
            <div class="col-md-4">                     
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            </div>
            
            </fieldset>
            </form>
    </div>
</div>

</x-app-layout>
