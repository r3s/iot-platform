{{-- To use generic form input snippet,  add "use Input;" in controller
      parameters:
			name:        (required) eg: some_name
      value:       (optional) eg: default_value. default= Input::old(name)
      id:          (optional) default = "id_some_name (for $name = some_name)
      widget:      (optional) default = text. "textarea/select" supported
      options      (optional) array of options (for select widget)
			autofocus:   (optional)
			type:        (optional), default = text
			placeholder: (optional), default = Some name (for $name = some_name)
			class:       (optional), default = "form-control"
      rows:        (optional), for textarea widget
      default_text: (optional), default textarea content (for textarea widget)
      accept: (optional), accepted MIME types for file input (comma seperated eg: "application/pdf")
--}}

@if (  $errors && $errors->first($name))
  <label class="control-label has-error"
  style="color:#a94442">{!!$errors->first($name)!!}</label>
  <div class="form-group has-error">
@else
  <div class="form-group">
@endif
@if (isset($block_field) && $type != "hidden")
  <label class="col-sm-2 col-sm-2 control-label">{{{ $placeholder or str_replace("_"," ",ucfirst($name)) }}}</label>
  <div class="col-sm-10">
@endif

<{{{$widget or "input"  }}} id="{{{ $id or "id_".$name  }}}" type="{{{ $type or "text" }}}" name="{{{ $name or "" }}}" class="{{{$fclass or "form-control"}}}" @if(!isset($block_field)) placeholder="{{{ $placeholder or str_replace("_"," ",ucfirst($name)) }}}" @endif {{{$autofocus or ""}}} @if(isset($rows)) rows="{{{$rows}}}" @endif @if (isset($accept)) accept="{{{ $accept }}}" @endif  value="{{ $value or Input::old($name)}}" >
@if (isset($widget))
@if($widget=="textarea"){{{ $default_text or Input::old($name)}}}@endif
@if (isset($options))
    @foreach ($options as $key=>$option)
      <option value="{{ $key }}">{{ $option }}</option>
    @endforeach
@endif
</{{{$widget}}}>
@endif
@if (isset($block_field))
</div>
@endif
  </div>
