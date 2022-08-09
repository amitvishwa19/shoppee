<nav class="main-menu navbar-expand-md navbar-light">
    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
        <ul class="navigation clearfix">

            @foreach($items as $item)

            <li class="nav-item {{ (!$item->children->isEmpty()) ? 'dropdown' : null  }} {{(request()->url() == url($item->link())) ? 'current' : ''}}">
                <a href="{{url($item->link())}}">
                    {{ $item->title }}
                </a>
                @if(!$item->children->isEmpty())
                    @foreach($item->children as $child)
                        <ul>
                            <li><a href="{{url($child->link())}}" >{{$child->title}}</a></li>
                        </ul>
                    @endforeach
                @endif
            </li>

            @endforeach

        </ul>
    </div>
</nav>
