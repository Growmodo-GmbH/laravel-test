<div>
    <h4 class="mb-4 text-2xl font-bold">Post </h4>
      <div>
          <div class="container mx-auto">
              <form method="POST" wire:submit.prevent="storePost">
                  @csrf
                  <div>
                      <label for="title">Title</label>
                      <input type="text" wire:model.lazy="title" class="w-full py-2 rounded">
                      @error('title')
                      <span class="text-red-600">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="mt-8">
                      <label class="block mb-2 text-xl">Description </label>
                      <textarea wire:model.lazy="description" rows="3" cols="20" class="w-full rounded">
                  </textarea>
                      @error('description')
                      <span class="text-red-600">{{ $message }}</span>
                      @enderror
                  </div>
                  @if($is_edit)
                    <button type="submit" wire:click="update" class="px-4 py-2 text-white bg-indigo-600 rounded">
                        Update
                    </button>
                    <button wire:click="update" class="px-4 py-2 mt-4 text-white bg-red-600 rounded">
                        Cancel
                    </button>
                @else
                  <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded">
                      Submit
                  </button>
                @endif
              </form>
          </div>
          <div class="flex flex-col mt-8">
              <div class="py-2">
                  <div
                      class="min-w-full border-b border-gray-200 shadow">
                      <table class="min-w-full">
                          <thead>
                              <tr>
                                  <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                      Id
                                  </th>
                                  <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                      Title
                                  </th>
                                  <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                      Edit
                                  </th>
                                  <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                      Delete
                                  </th>
                              </tr>
                          </thead>

                          <tbody class="bg-white">
                              @foreach($posts as $post)
                              <tr>
                                  <td class="px-6 py-4 border-b border-gray-200">
                                      <div class="flex items-center">
                                          <div class="ml-4">
                                              <div class="text-sm text-gray-900">
                                                  {{ $post->id }}
                                              </div>
                                          </div>
                                      </div>
                                  </td>

                                  <td class="px-6 py-4 border-b border-gray-200">
                                      <div class="text-sm text-gray-900">
                                          {{ $post->title }}
                                      </div>
                                  </td>

                                  <td class="px-6 py-4 border-b border-gray-200">
                                      <button wire:click="edit({{ $post->id }})" class="px-4 py-2 text-white bg-indigo-600">
                                          Edit
                                      </button>
                                  </td>

                                  <td class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200">
                                      <button wire:click="destroy({{ $post->id }})"
                                          class="px-4 py-2 text-white bg-red-600">
                                          Delete
                                      </button>
                                  </td>

                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  {{ $posts->links() }}
              </div>
          </div>
      </div>
  </div>
