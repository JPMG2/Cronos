@extends("pdfLayouts.stylePdf")
@section("title", $title)
@section("content")
    <p>{{ $content }}</p>
@endsection
