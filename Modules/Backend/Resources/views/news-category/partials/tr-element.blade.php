<tr data-id="{{ $category->id }}"
    data-parent="{{ $category->parent_id?$category->parent_id:0 }}"
    data-level="{{ $padding }}">
    <td data-column="name"
        data-level="{{ $padding }}">
        {{$category->name}}</td>
    <td>

        @if($category->position)
            Navbar
            : {{$category->position->front_header_position
                ? 'Main page('.$category->position->front_header_position.')':''}}
            -
            {{$category->position->detail_header_position
                    ? 'Category page('.$category->position->detail_header_position.')':''}}


            <hr style="margin: 5px">
            Body  : {{$category->position->front_body_position
                ? 'Main page('.$category->position->front_body_position.')':''}}
            -
            {{$category->position->detail_body_position
                    ? 'Category page('.$category->position->detail_body_position.')':''}}

        @endif

    </td>
    <td>{!! spanByStatus($category->is_active) !!}</td>
    <td>
        @can('news-category-edit')
            <a href="{{route($routePrefix.'category.edit',$category->id)}}"
               class="btn btn-primary btn-sm btn-flat">
                <i class="fa fa-edit"></i>
            </a>
        @endcan
        @can('news-category-delete')
            {!! Form::open(['method' => 'DELETE', 'route' =>
            [$routePrefix.'category.destroy',$category->id],
            'onsubmit' => "return confirm('Are you sure you want to delete?')", 'style'=>"display:inline"
            ])!!}
            <button class="btn btn-danger btn-flat btn-sm" role="button" type="submit">
                <i class="fa fa-trash"></i>
            </button>
            {!! Form::close() !!}
        @endcan
    </td>
</tr>
<?php
$padding = $padding + 1;
?>
@foreach($category->childCategories as $childCategory)

    @include('backend::news-category.partials.tr-element',['category'=>$childCategory,'padding'=>$padding])
@endforeach
