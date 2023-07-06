<x-admin-layout>

    <div class="w-full px-6 py-6 mx-auto">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>Authors table</h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0">
                            <div class="container mx-auto py-8">
                                <h1 class="text-2xl font-bold mb-6 text-center">Update "{{ $category->name }}" category</h1>
                                <form class="w-full max-w-sm mx-auto bg-white p-8 rounded-md shadow-md"
                                      action="{{route('admin.categories.update', $category)}}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')

                                    @if (!empty($categories))
                                        <div class="mb-4">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="parent">Parent</label>
                                            <select name="parent_id" id="parent"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                                                <option value=""></option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}"
                                                            {{ $cat->id === $category->parent_id ? 'selected' : '' }}
                                                    >{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                                        </div>
                                    @endif
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="name">Name</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="text" id="name" name="name" placeholder="Category name" value="{{ $category->name }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                                        <textarea
                                            rows="4"
                                            name="description"
                                            id="description"
                                            placeholder="Type your message"
                                            class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        >{{ $category->description }}</textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>

                                    <x-button action="submit" type="button" class="w-full m-0 font-bold">Update
                                        Category
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
