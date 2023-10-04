<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>admin</title>
	<!-- Bootstrap -->
	<link rel="icon" href="{{ asset('asset/images/moblogo.png') }}" type="image/png" sizes="16x16">
	<link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('asset/css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/jquery.ccpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/countrySelect.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/simplePagination.css" integrity="sha512-emkhkASXU1wKqnSDVZiYpSKjYEPP8RRG2lgIxDFVI4f/twjijBnDItdaRh7j+VRKFs4YzrAcV17JeFqX+3NVig==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/simplePagination.min.css" integrity="sha512-85KEMf8eFSgiFrs/gGSVg0S6JqrmCtvVcA+s1PTMl/qtqH0ucmhrYrAFXock7iSjCaVcCMUNgCEF+sdQBUp7pA==" crossorigin="anonymous" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<style type="text/css">
	  div.dataTables_wrapper div.dataTables_filter label { width: 80%!important;}
	  div.dataTables_wrapper div.dataTables_filter input { width: 80%!important;}
	</style>
</head>