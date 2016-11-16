# Laravel Components With Blade

This is an example on how to make your own "components" with Blade and reuse them.

The main idea is to take advantage of the **@yield** and **@section** directives to achieve this.

## Setup

For first, We need a [Master Layout](https://github.com/pakogn/laravel-components-with-blade/blob/111c1f1a09abde485032899aa1d6e7f292886116/resources/views/layouts/master.blade.php):

[*/resources/views/layouts/master.blade.php*](https://github.com/pakogn/laravel-components-with-blade/blob/111c1f1a09abde485032899aa1d6e7f292886116/resources/views/layouts/master.blade.php)

```html
<!DOCTYPE html>
<html>
	<head>
		<title>Laravel Components</title>

		<style type="text/css">
			@stack('css')
		</style>
	</head>
	<body>
		@yield('content')

		<script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery-3.1.1.min.js') }}"></script>

		<script type="text/javascript">
			@stack('javascript')
		</script>
	</body>
</html>
```

```
Notice that we are using jQuery for convenience.
```

Now that we have our layout, let's create our component. A suggestion is to save them in */resources/views/components*, so lets create a simple alert component.

*[/resources/views/components/alert/component.blade.php](https://github.com/pakogn/laravel-components-with-blade/blob/master/resources/views/components/alert/component.blade.php)*

```html
@push('javascript')
	$('.alert').slideDown(600);
@endpush

<div class="alert {{ $type or 'alert-info' }}" style="display: none;" role="alert">
	@yield($id.'Content')
</div>

@push('css')
	.alert {
	    padding: 15px;
	    margin-bottom: 20px;
	    border: 1px solid transparent;
	    border-radius: 4px;
	}
	.alert-success {
	    color: #3c763d;
	    background-color: #dff0d8;
	    border-color: #d6e9c6;
	}
	.alert-info {
	    color: #31708f;
	    background-color: #d9edf7;
	    border-color: #bce8f1;
	}
	.alert-warning {
	    color: #8a6d3b;
	    background-color: #fcf8e3;
	    border-color: #faebcc;
	}
	.alert-danger {
	    color: #a94442;
	    background-color: #f2dede;
	    border-color: #ebccd1;
	}
@endpush
```

This is a simple component definition, now let's use it to see it's power. Let's create a view to use the component.

*[/resources/views/index.blade.php](https://github.com/pakogn/laravel-components-with-blade/blob/111c1f1a09abde485032899aa1d6e7f292886116/resources/views/index.blade.php)*

```html
@extends('layouts.master')

@section('content')
	@section('infoAlertContent')
		Common Alert!
	@stop
	@include('components.alert.component', [
		'id' => 'infoAlert',
	])

	@section('dangerAlertContent')
		This is an Error Alert!
	@stop
	@include('components.alert.component', [
		'id' => 'dangerAlert',
		'type' => 'alert-danger'
	])
@stop
```

Notice that we have to register a route to return the view created. A simple approach is to replace the existing route in *[/routes/web.php](https://github.com/pakogn/laravel-components-with-blade/blob/111c1f1a09abde485032899aa1d6e7f292886116/routes/web.php)* to have this:

```php
Route::get('/', ['as' => 'index', function () {
    return view('index');
}]);
```

Now it's time to check our setup!

run:
  1. composer install
  2. php artisan serve
  3. go to [http://localhost:8000](http://localhost:8000)

## Explanation

Firstly, let's review the [implementation](https://github.com/pakogn/laravel-components-with-blade/blob/111c1f1a09abde485032899aa1d6e7f292886116/resources/views/index.blade.php).

```html
@section('dangerAlertContent')
	This is an Error Alert!
@stop
@include('components.alert.component', [
	'id' => 'dangerAlert',
	'type' => 'alert-danger'
])
```

A suggestion is to have an id per component to make it unique. This identifier allows us to inject content in the component's yield sections. So when we are referring to the **@section('dangerAlertContent')** it's because we are referring the component's implementation id concatenated with the name of the component's yield section defined.

```
Notice that firstly we are referring the component's yield sections and secondly we are including the component.
```

We can reference to the component's "dynamic" sections thanks to the next [implementation](https://github.com/pakogn/laravel-components-with-blade/blob/master/resources/views/components/alert/component.blade.php#L6) of the **@yield** directive:

```html
@yield($id.'Content')
```

Using this suggestion of component definition it's kind of inefficient because the javascript and css will be pushed to the stack on every implementation. So the styles and scripts should be in their respective assets files.

## Furthermore

In Addition there are a few commits showing the implementation of a data table component:

[adding a simple data table component.](https://github.com/pakogn/laravel-components-with-blade/commit/1213fe1e7d85cd56afc182a29d2bbd581b1592f9)

Also, adding support for more interesting cases:

[adding simple support when there are no elements.](https://github.com/pakogn/laravel-components-with-blade/commit/fef525894c52b887bbfa3d84ef4b9e7a898e22b2)

Any question or suggestion feel free to contact me at daniel@garcianoriega.com.