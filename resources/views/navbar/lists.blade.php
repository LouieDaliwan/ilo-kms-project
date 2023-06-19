<ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
    @foreach(['Home', 'Members', 'About', 'Contact'] as $list)
        <li>
            <a href="#" aria-current="page"
                class="{{
                    (request()->is(strtolower($list))) ? 'text-blue-300' : 'text-white dark:text-white'
                }}
                block
                py-2
                pl-3
                pr-4
                rounded
                md:p-0"
                >
                {{ $list}}
            </a>
        </li>
    @endforeach
</ul>
