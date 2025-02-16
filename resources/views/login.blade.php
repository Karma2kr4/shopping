<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminlte/formLogin/css/my-login.css') }}">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="{{ asset('adminlte/formLogin/img/logo.jpg') }}" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center">Login</h4>
							<form method="POST" id="login-form" action="{{ url('/admin') }}" class="my-login-validation" novalidate="">
								@csrf
								<!-- Hiển thị lỗi chung cho toàn bộ form -->
								@if($errors->has('loginError'))
									<div class="alert alert-danger">
										{{ $errors->first('loginError') }}
									</div>
								@endif

								<div class="form-group">
									<label for="name">Tên đăng nhập</label>
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="form-group">
									<label for="password">Mật khẩu</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
									@error('password')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember_me" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Ghi nhớ đăng nhập</label>
									</div>
								</div>

								<div class="form-group m-0">
									<!-- Hiển thị lỗi nếu có -->
									<button type="submit" class="btn btn-primary btn-block @if($errors->has('loginError')) is-invalid @endif">
										Đăng nhập
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2024 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="{{ asset('adminlte/formLogin/js/my-login.js') }}"></script>
</body>
</html>






