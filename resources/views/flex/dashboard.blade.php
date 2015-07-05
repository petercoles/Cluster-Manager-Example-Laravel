<!DOCTYPE html>
<html lang="en">
<head>
	<meta chaset="UTF-8">
	<title>Flex Prototype</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
	<link rel="stylesheet" href="/css/styles.css">
</head>

<body id="dashboard" class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Flex Prototype</h1>

			<hr>

			<div class="row">
				<div class="col-md-3">
				  <div class="box">
				    <h2>Managers</h2>
				    <i class="fa fa-user fa-3x"></i>
				    <span class="headline-number">@{{ managers }}</span>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="box">
				    <h2>Workers</h2>
				    <i class="fa fa-users fa-3x"></i>
   				    <span class="headline-number">@{{ workers }}</span>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="box">
				    <h2>Jobs</h2>
				    <i class="fa fa-cog fa-3x" v-class="fa-spin:jobStatus=='active',fa-pulse:jobStatus=='waiting'"></i>
   				    <span class="headline-number">@{{ jobs }}</span>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="box">
				    <h2>Uploads</h2>
					<form action="/file-upload" class="dropzone">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					</form>
				  </div>
				</div>
			</div>

			<hr>

			<table class="table">
				<thead>
					<tr>
						<th>Reference</th>
						<th>Customer</th>
						<th>Currency</th>
						<th>Value</th>
						<th>Filename</th>
					</tr>
				</thead>
				<tbody>
					<tr v-repeat="documents">
						<td>@{{ reference }}</td>
						<td>@{{ customer }}</td>
						<td>@{{ currency }}</td>
						<td>@{{ value/100 | currency ' ' }}</td>
						<td>@{{ path }}</td>
					</tr>
				</tbody>
			</table>

			</div>

			<hr>

			<div id="global-actions" class="row">
				<div class="col-md-12"><button type="button" class="btn btn-danger" v-on="click: teardown">Teardown</button></div>
			</div>
		</div>
	</div>

	<script src="/js/vendor.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
	<script src="/js/app.js"></script>
</body>
</html>