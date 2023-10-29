
<div id="content" class="mx-auto" style="max-width:500px;">
    <div class="container content py-6 mx-auto">
        <div class="mx-auto">

        </div>
    </div>
    <div id="todos-list">
        @foreach($lists as $list)

            <div class="todo mb-5 card px-5 py-6 bg-white col-span-1 border-t-2 border-blue-500 hover:shadow">
                <div class="flex justify-between space-x-2">

                    <div class="flex items-center">
                        <h3  class="text-lg text-semibold text-gray-800"> <a wire:navigate href="{{route('list',['id' => $list->id])}}">{{ $list->name }} <span >({{ $list->todos_count }} todos )</span></a></h3>
                    </div>

                    <div class="flex items-center space-x-2">
                        @if(!in_array($list->id, $this->subscribedIds))
                        <button wire:click="subscribe({{$list->id}})"
                                class="mt-3 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Subscribe</button>
                        @else
                        <button wire:click="unsubscribe({{$list->id}})"
                                class="mt-3 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Unsubscribe</button>
                        @endif

                    </div>
                </div>
                <span class="text-xs text-gray-500">{{ $list->created_at }} </span>
                <div class="mt-3 text-xs text-gray-700">
                </div>
            </div>
        @endforeach
        <div class="my-2">
            {{ $lists->links() }}
        </div>
    </div>
</div>

