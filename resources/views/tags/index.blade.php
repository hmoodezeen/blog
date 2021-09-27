@extends('layouts.app')

@section('content')
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<div class="clearfix"><a href="{{route('tags.create')}}" class="btn float-right btn-success" style="margin-bottom: 10px"> Add tag </a></div>
    <div class="card card-default">
        <div class="card-header">ALL tags</div>
        <table class="card-body">
            <table class="table">
                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>
                            {{ $tag->name }} <span class="badge badge-primary ml-2"> {{ $tag->posts->count() }} </span>
                        </td>
                        <td>
                            <form class="float-right ml-2" action="{{route('tags.destroy' , $tag->id)}}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                            <a href="{{route('tags.edit' , $tag->id)}}" 
                                class="btn btn-primary float-right btn-sm">Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>
@endsection
