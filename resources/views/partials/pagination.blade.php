<div class="row mt-3">
    <div class="col-6">
        <p class="float-left">Displaying {{ $displayedResults }} of {{ $totalResults }}</p>
    </div>
    <div class="col-6">
        <nav class="float-right">
            <ul class="pagination">
                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route($routeName, ['page' => 1]) }}">Previous</a>
                </li>

                {{--    display a link with page number dynamicaly   --}}
                @for($i = 1; $i <= $totalPages; $i++)
                    <li class="page-item {{ $currentPage == $i ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ route($routeName, ['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route($routeName, ['page' => $totalPages]) }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
