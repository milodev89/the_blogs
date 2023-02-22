<nav class="col-md-2 bg-primary text-white d-flex flex-column offset-md-1" style="border-radius:10px">
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{route('user_edit', auth()->user()->uuid)}}" class="nav-link text-white" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                    My profile
                    </a>
                </li>
                <li>
                    <a href="{{url('/user/my_posts/'.auth()->user()->uuid)}}" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    My Posts
                    </a>
                </li>
                <li>
                    <a href="{{url('/user/my_favs/'.auth()->user()->uuid)}}" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                    My Favs
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                <li>
                    <a href="{{url('/user/review_posts')}}" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                    Review
                    </a>
                </li>
                @endif
            </ul>
        </nav>