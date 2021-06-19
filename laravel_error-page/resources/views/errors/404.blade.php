@extends('errors.layouts.base')

@section('http-request', '404')

@section('title', 'Page not found')

@section('message', 'This may not mean anything.')
{{-- 該当アドレスのページを見つける事ができませんでした。 --}}

@section('detail', "I'm probably working on something that has blown up.")
{{-- サーバーは要求されたリソースを見つけることができなかったことを示します。 URLのタイプミス、もしくはページが移動または削除された可能性があります。 トップページに戻るか、もう一度検索してください。 --}}
