<tr>
    <th class="text-center">{{ucwords(str_replace('-',' ',$permission_name))}}</th>
    <td class="text-center">
        <div class="checkbox icheck">
            <label>
                {{ Form::checkbox('full-access[]',$permission_name.'-full', false , ['class' => 'full-access iCheck']) }}
            </label>
        </div>
    </td>
{{--    @dd($permissions)--}}
    @foreach($access as $key)
        <td class="text-center">
            <div class="checkbox icheck">
                <label>
                    {{ Form::checkbox('permission[]',
                    $permission_name.'-'.$key,
                    isset($permissions) &&
                     $permissions->contains($permission_name.'-'.$key),
                     ['class' => $key.'-access access-permission iCheck']) }}
                </label>
            </div>
        </td>
    @endforeach

</tr>
