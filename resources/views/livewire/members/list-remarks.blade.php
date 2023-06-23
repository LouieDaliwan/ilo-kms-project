<div class="overflow-y-scroll h-[200px] mb-10" id="remarks">
    @foreach($remarks as $remark)
    <article class="p-6 mb-3 text-base bg-white rounded-lg dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-1">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                    {{-- <img
                        class="mr-2 w-6 h-6 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                        alt="Michael Gough"> --}}
                        {{$remark->author->fullname}}
                    </p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                        title="February 8th, 2022">{{ $remark->created_at->format('M d,y h:iA')}}</time></p>
            </div>
        </footer>
        <p class="text-gray-500 dark:text-gray-400">{{ $remark->remarks }}
        </p>
    </article>
    @endforeach
</div>

<script>
    let container = document.querySelector('#remarks');

    window.addEventListener('DOMContentLoaded', () => {
        container.scrollTop = container.scrollHeight;
    });

    window.addEventListener('scrollDown', () => {
        Livewire.hook('message.processed', function() {
            if (container.scrollTop + container.clientHeight + 200 < container.scrollHeight) {
                return
            }

            container.scrollTop = container.scrollHeight;
        });
    });
</script>

