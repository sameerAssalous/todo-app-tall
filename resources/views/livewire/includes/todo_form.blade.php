<div x-data="{ open: false }" class="mx-auto">
    <div  x-show="!open" class="hover:shadow p-6 bg-white border-blue-500 border-t-2">
        <div class="flex items-center ">
            <button type="button" @click="open = ! open"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">{{__('messages.show_create_form')}}
            </button>
        </div>
    </div>
    <div id="create-form" x-show="open" class="hover:shadow p-6 bg-white border-blue-500 border-t-2">
        <div class="flex justify-between space-x-2">

            <div class="flex items-center space-x-2">
                <h2 class="font-semibold text-lg text-gray-800 mb-5">{{__('messages.add_todo')}}</h2>
            </div>
            <div class="flex items-center space-x-2">
                <button @click="open = ! open" class="text-sm text-red-500 font-semibold rounded hover:text-teal-800 mr-1">
                    <svg viewPort="0 0 12 12" version="1.1"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <line x1="1" y1="11"
                              x2="11" y2="1"
                              stroke="black"
                              stroke-width="2"/>
                        <line x1="1" y1="1"
                              x2="11" y2="11"
                              stroke="black"
                              stroke-width="2"/>
                    </svg>
                </button>
            </div>
        </div>
        <div>
            <form>
                <div class="mb-6">
                    <label for="title"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                        {{__('messages.todo')}} </label>
                    <input type="text" wire:model="content" wire:keydown.enter="addTodo" id="title" placeholder="{{__('messages.add_todo')}}.."
                           class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                    @error('content')
                    <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                    @enderror

                </div>
                <button type="submit" wire:click.prevent="addTodo"
                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">{{__('messages.create')}}
                    +</button>
                @if(session('success'))
                    <span class="text-green-500 text-xs">{{session('success')}}</span>
                @endif

            </form>
        </div>
    </div>
</div>
