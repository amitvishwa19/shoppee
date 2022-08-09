<ol class="dd-list">
    @foreach ($categories as $category)
        <li class="dd-item dd-collapsed" data-id="{{ $category->id }}" class="mb-4">

        
            <div class=" pull-right item_actions float-right mt-1 mr-2">
                <a href="{{ route('product_category.edit' , $category->id)}}" class="btn btn-default btn-xs del-button dt-action-btn mp-0">Edit</a>
                <a href="javascript:void(0);" class="btn btn-default btn-xs del-button dt-action-btn btn-menu-item delete" id="{{$category->id}}">Delete</a>
            </div>

            <div class="dd-handle">
                <span>{{ $category->name }} ({{ $category->products()->count()}})
            </div>

            

                
            @if(!$category->child->isEmpty())
                @include('admin.pages.product_category.child_cat',['categories' => $category->child])
            @endif
        </li>
    @endforeach
   
</ol>

