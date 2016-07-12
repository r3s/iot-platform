@if (  $errors && $errors->first($name))
  <label class="control-label has-error"
  style="color:#a94442">{!!$errors->first($name)!!}</label>
  <div class="form-group has-error">
@else
  <div class="form-group">
@endif
@if (isset($block_field))
  <label class="col-sm-2 col-sm-2 control-label">{{{ $placeholder or str_replace("_"," ",ucfirst($name)) }}}</label>
  <div class="col-sm-10">
@endif
<select id="{{{ $id or "" }}}" name="{{{ $name or "" }}}" class="{{{$fclass or "form-control"}}}" {{{$autofocus or ""}}}>
	@foreach ($options as $key=>$option)
		<option value="{{ $key }}" @if(!empty($selected) && $selected == $key) {{ 'selected' }} @endif>{{ $option }}</option>
	@endforeach
</select>
@if (isset($block_field))
</div>
@endif
</div>
